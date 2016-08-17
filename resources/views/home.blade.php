@extends('layouts.app')

@section('content')
    <div id="gradient" class="full-page homepage-header">
        <div class="homepage-inner-wrapper">
            <h1>GoCON</h1>

            <div class="register-button">
                <a href="{{URL::to('/register')}}"><span>register</span></a>
            </div>

            <div class="homepage-header-separator"></div>
            <p>Already have an account ?</p>
            <p class="login-options">
                <a href="{{URL::to('/goToLogin')}}">Sign In</a> or <a href="{{URL::to('/redirect')}}">Login with Facebook</a>
            </p>
        </div>
    </div>

    <div class="full-page homepage-content">

    </div>
@endsection
