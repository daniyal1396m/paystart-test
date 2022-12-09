<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <title>Daniel Motahari</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,700&display=swap" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet"/>
</head>

<body>
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a class="navbar-brand" href="index.html">
                    <img src="images/logo.png" alt=""/><span>
              Zezmon
            </span>
                </a>

                <div class="navbar-collapse" id="">
                    <div class="container">
                        <div class=" mr-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav justify-content-between ">
                                <div class="d-none d-lg-flex">
                                    <li class="nav-item">
                                        <a class="nav-link" href="fruit.html">
                                            Customer Number : 01234567890</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="service.html">
                                            Demo@gmail.com
                                        </a>
                                    </li>
                                </div>
                                <div class=" d-none d-lg-flex">
                                    @guest()
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                   href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    @endguest
                                </div>
                            </ul>
                        </div>
                    </div>

                    <div class="custom_menu-btn">
                        <button onclick="openNav()"></button>
                    </div>
                    <div id="myNav" class="overlay">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <div class="overlay-content">
                            <a href="index.html">HOME</a>
                            <a href="product.html">PRODUCTS</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section --><!-- footer section -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{$carts->count()}}</span>
                </h4>
                <ul class="list-group mb-3">
                        <?php
                        $total = 0;
                        ?>
                    @foreach($carts as $cart)
                            <?php
                            $total += $cart['product']['price'];
                            ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{$cart['product']['title']}}</h6>
                                <small class="text-muted">{{$cart['product']['title']}}</small>
                            </div>
                            <span class="text-muted">${{$cart['product']['price']}}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{$total}}</strong>
                    </li>
                </ul>
                @if(!session('token'))
                    <form action="{{route('api.pay.store')}}" method="post">
                        @csrf
                        <button type="submit">pay order</button>
                    </form>
                @endif
                @if(session('token'))
                    <form action="https://core.paystar.ir/api/pardakht/payment" method="post">
                        <input type="hidden" value="{{session('token')}}">
                        @csrf
                        <button type="submit">pay</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <section class="container-fluid footer_section">
        <p>
            Copyright &copy; 2019 All Rights Reserved By
            <a href="https://html.design/">Free Html Templates</a>
        </p>
    </section>
    <!-- footer section -->

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>
</div>
</body>

</html>
