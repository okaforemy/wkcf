<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
         <link href="https://fonts.googleapis.com/css?family=Crimson+Text|Josefin+Sans|Montserrat|Roboto+Slab&display=swap" rel="stylesheet"> 
    <link href="{{asset('css/wkf.css') }}" rel="stylesheet">
        <!-- Styles -->

        <!--


    font-family: 'Montserrat', sans-serif;

    font-family: 'Roboto Slab', serif;

    font-family: 'Crimson Text', serif;

    font-family: 'Josefin Sans', sans-serif;

-->
        <style>
@media (min-width: 576px) {
                .title.m-b-md {
    font-size: 1.3em;
    font-weight: bold;
    color: white;
    text-transform: uppercase;
}

.title.m-b-md p {
    font-size: 11px;
    margin-top: 15px;
    padding: 0 50px;
}

.title.m-b-md span{
    color: #c70039;
}

            }

            // Medium devices (tablets, 768px and up)
            @media (min-width: 768px) {
                .title.m-b-md {
    font-size: 1.6em;
    font-weight: bold;
    color: white;
    text-transform: uppercase;
}

.title.m-b-md p {
    font-size: 12px;
    margin-top: 15px;
    padding: 0 50px;
}

.title.m-b-md span{
    color: #c70039;
}

            }

            // Large devices (desktops, 992px and up)
            @media (min-width: 992px) {
                .title.m-b-md {
    font-size: 1.8em;
    font-weight: bold;
    color: white;
    text-transform: uppercase;
}

.title.m-b-md p {
    font-size: 14px;
    margin-top: 15px;
    padding: 0 50px;
}

.title.m-b-md span{
    color: #c70039;
}

            }
.title.m-b-md {
    font-size: 2.0em;
    font-weight: bold;
    color: white;
    text-transform: uppercase;
}

.title.m-b-md p {
    font-size: 17px;
    margin-top: 15px;
    padding: 0 50px;
}

.title.m-b-md span{
    color: #c70039;
}

            // Extra large devices (large desktops, 1200px and up)
            @media (min-width: 1200px) { 
.title.m-b-md {
    font-size: 2.5em;
    font-weight: bold;
    color: white;
    text-transform: uppercase;
}

.title.m-b-md p {
    font-size: 20px;
    margin-top: 15px;
    padding: 0 50px;
}

.title.m-b-md span{
    color: #c70039;
}

            }


        
            html, body {
                //background-color: #fff;
                color: #636b6f;
                font-family: 'Josefin Sans', sans-serif;
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
                //font-size: 84px;
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

            @media (max-width: 576px){
              .title.m-b-md {
    font-size: 1.2em;
    font-weight: bold;
    color: white;
    text-transform: uppercase;
}

.title.m-b-md p {
    font-size: 11px;
    margin-top: 15px;
    padding: 0 50px;
}

.title.m-b-md span{
    color: #c70039;
}
  
            }
            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height hero-div">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Enter for Quiz</a>
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
                    Welcome to <span>Who Knows the Faith</span> Quiz Competition!
                    <p>A Quiz competition organized by St. Andrews Parish, (A Catholic parish of the Archdiocese of Abuja) Orozo - Abuja</p>
                </div>
            </div>
        </div>
    </body>
</html>
