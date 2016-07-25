@extends('layouts.app')

@section('content')
    <h1>{{$user->name}}</h1>

    @if ($doyoumatch)
        <h2>MATCH</h2>
    @else
        <h2>NO MATCH</h2>
    @endif

    <a href="{{URL::to('chat/solo', $user->id)}}">CHAT</a><br/>
@endsection