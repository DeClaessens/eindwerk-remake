@extends('layouts.app')

@section('content')

    @foreach($messages as $message)
        <p>{{$message->senderUser->name}}: {{$message->message}}</p>

    @endforeach
    {!! Form::open(array('url' => array('chat/solo/send', $otherUser->id))) !!}
        {!! Form::text('message') !!}
        {!! Form::submit('submit') !!}
    {!! Form::close() !!}
@endsection