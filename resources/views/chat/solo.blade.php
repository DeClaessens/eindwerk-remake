@extends('layouts.app')

@section('content')

    @foreach($messages as $message)
        <p>{{\App\User::find($message->sender)->name}}: {{$message->message}}</p>
    @endforeach
    {!! Form::open(array('url' => array('chat/solo/send', $otherUser->id))) !!}
        {!! Form::text('message') !!}
        {!! Form::submit('submit') !!}
    {!! Form::close() !!}
@endsection