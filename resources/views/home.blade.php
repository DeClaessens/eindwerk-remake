@extends('layouts.app')

@section('content')
    <div class="background">

    </div>
    <a href="{{ url('/goToLogin') }}" class="aanmelden-container">Aanmelden</a>
    <div class="homepage-container">
        <div class="homepage-content">
            <div class="homepage-header">
                <h1>GoCON</h1>
                <p>Vindt je niemand om mee naar een concert te gaan ?<br/>Vindt hier per concert andere mensen om samen mee te gaan!</p>
            </div>
            <div class="divider"></div>
            <div class="homepage-body">
                <div class="homepage-body-step-container">
                    <div class="homepage-body-step" id="step-1">
                        <span>Zoek!</span>
                    </div>
                    <div class="homepage-body-step" id="step-2">
                        <span>Swipe!</span>
                    </div>
                    <div class="homepage-body-step" id="step-3">
                        <span>Chat!</span>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <div class="homepage-register">
                <a class="register-button" href="{{url('/register')}}">Registreer</a>
                <p>of</p>
                <a class="facebook" href="{{url('/redirect')}}"><i class="fa fa-facebook-official" aria-hidden="true"></i>Registreer met Facebook</a>
            </div>
        </div>
    </div>
@endsection
