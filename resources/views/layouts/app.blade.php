<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

    <title>GoCon | Find Concertbuddies</title>

    <!-- Fonts -->
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
                            <a href="{{url('/concerts')}}">Concerts</a>
                        </li>
                        <li>
                            <a href="{{url('/matches')}}">Matches</a>
                        </li>
                        <li>
                            <a href="{{url('/chat')}}">Messages</a>
                        </li>
                    </ul>
                    <div class="nav-profile-image" style="background: url('{{Auth::user()->imageUrl}}') center center no-repeat; background-size: cover;">

                    </div>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('/profile')}}">Profile</a>
                        </li>
                        <li>
                            <a href="{{url('/profile/edit')}}">Edit Profile</a>
                        </li>
                        <li>
                            <a href="{{url('/logout')}}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        @yield('content')
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--<script src="{{ asset('js/jquery.js') }}"></script>-->
    <script src="{{ asset('js/jquery.transform2d.js') }}"></script>
    <script src="{{ asset('js/jquery.jTinder.js') }}"></script>
    <script src="{{ asset('js/holmes.js') }}"></script>
    @if(Auth::check())
        <script src="//js.pusher.com/3.0/pusher.min.js"></script>
        <script src="{{ asset('js/notify.min.js') }}"></script>
        <script>
            Pusher.log = function(message) {
                if (window.console && window.console.log) {
                    window.console.log(message);
                }
            };
            var pusher = new Pusher("{{env("PUSHER_KEY")}}", {
                cluster: 'eu'
            });

            var channel = pusher.subscribe('gocon-channel');
            channel.bind('user-notify-{{Auth::user()->id}}', function(data) {
                $.notify(data.text, {
                    className:'notification',
                    globalPosition: 'top right'
                });
            });

        </script>
    @endif

    <script src="{{ asset('js/code.js') }}"></script>
    @yield('javascripts')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
