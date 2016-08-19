<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <script src="https://use.fontawesome.com/5f03e3a277.js"></script>
    <link href="{{ asset('css/jTinder.css') }}" rel="stylesheet" type="text/css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('sass/app.css')  }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <div class="outer-wrapper">
        @if(Auth::check())
            <div class="user-nav">
                <div class="grid-container">
                    <div class="logo">
                        <a href="{{url('/')}}">GoCON</a>
                    </div>
                    <ul class="menu">
                        <li>
                            <a href="{{url('/concerts')}}">Concerts</i></a>
                        </li>
                        <li>
                            <a href="{{url('/chat')}}">Matches</a>
                        </li>
                        <li>
                            <a href="{{url('/profile')}}">Chat</a>
                        </li>
                    </ul>
                    <div class="nav-profile-image">

                    </div>
                </div>
            </div>

        @endif
        @yield('content')
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.transform2d.js') }}"></script>
    <script src="{{ asset('js/jquery.jTinder.js') }}"></script>
    <script src="{{URL::to('/js/code.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
