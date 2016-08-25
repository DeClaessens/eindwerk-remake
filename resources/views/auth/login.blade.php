@extends('layouts.app')

@section('content')
    <div class="user-nav">
        <div class="grid-container">
            <div class="logo">
                <a href="{{url('/')}}">GoCON</a>
            </div>
        </div>
    </div>
    <div class="full-page">
        <div class="grid-container">
            <div class="auth-container">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">


                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="facebook-register-container">
                        <div class="facebook-register-inner-container">
                            <a class="facebook" href="{{url('/redirect')}}"><i class="fa fa-facebook-official" aria-hidden="true"></i>Aanmelden met Facebook</a>
                            <p>(we publiceren niets op je tijdlijn)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
