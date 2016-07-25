@extends('layouts.app')

@section('content')
    <div class="homepage">
        <div class="header">
            <div class="header-inner-container">
                <h1>Go<span class="logo-span">Con</span></h1>

                <div class="login-container">
                    <a href="{{ url('/login') }}" class="login-button">Login</a>
                    <a href="{{ url('/register') }}" class="register-button">Register</a>
                </div>
            </div>

            <div class="scrolldown">
                <a href="#">placeholder for image</a>
            </div>
        </div>

        <div class="homepage-content-container">
            <p class="center-the-fuck-up">Ever wanted to go to a concert, but couldn't find anyone to go with ?</p>
            <p>GoCon connects you the people with similar concert interests. That way, you will never have to go to Nickelback alone anymore!</p>
        </div>
    </div>
@endsection
