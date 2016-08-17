@extends('layouts.app')

@section('content')
    <div class="profile-container">

            <h1>Edit page</h1>


            {!! Form::open(array('url' => 'profile/save-new-password')) !!}

            {!! Form::label('password', 'Enter a password for your account') !!}
            {!! Form::password('password', '') !!}

            {!! Form::submit('Submit password') !!}

            {!! Form::close() !!}
    </div>
@endsection