<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Rave Payment Integration
                </div>

                @php
                    $array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
                                    array('metaname' => 'size', 'metavalue' => 'big'));
                @endphp
                <h6>Buy Movie Tickets KES 50.00</h6>
                <form method="POST" action="{{ route('pay') }}" id="paymentForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="amount" value="50" />
                    <input type="hidden" name="payment_method" value="both" />
                    <input type="hidden" name="description" value="Beats by Dre. 2017" />
                    <input type="hidden" name="country" value="NG" />
                    <input type="hidden" name="currency" value="NGN" />
                    <input type="hidden" name="email" value="test@test.com" />
                    <input type="hidden" name="firstname" value="Oluwole" />
                    <input type="hidden" name="lastname" value="Adebiyi" />
                    <input type="hidden" name="metadata" value="{{ json_encode($array) }}" >
                    <input type="hidden" name="phonenumber" value="0746998777" />
                    <input type="submit" value="Buy"  />
                </form>
            </div>
        </div>
    </body>
</html>
