<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{
    public function pay_store()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $amount = 0;
        foreach ($carts as $cart) {
            $amount += $cart['product']['price'];
        }
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'amount' => $amount
        ]);
        $hash = hash_hmac('SHA512', $amount . '#' . $order['id'] . '#' . 'http://127.0.0.1:8000/pay/store/response', '9A3EC03483556C73714510C507529DF70A1228C83477D1455E0511BD72C5AAB8A6715A414AA48B7C905FCEF45868BD26DA58196EF29C77C194C9F14A4B47456CC6454E9D50B388D6FC5AC91BB08B234A8060FDC85B1CEC32CA036DC907F8A4A635D9CBB9CAA31B42549B8D70B2CE5EDE8274FFB55DABFE92D76BC42D91696FAF');
        $sing = '{
    "amount": ' . $amount . ',
    "order_id": "' . $order['id'] . '",
    "callback": "http://127.0.0.1:8000/pay/store/response",
    "sign":"' . $hash . '"}';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://core.paystar.ir/api/pardakht/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $sing,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer 0yovdk2l6e143'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return redirect()->back()->with('token', $hash);
    }

    public function pay_store_response(Order $id)
    {
        dd($id);
    }
}
