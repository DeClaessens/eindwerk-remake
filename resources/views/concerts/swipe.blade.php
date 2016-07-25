@extends('layouts.app')

@section('content')
    @foreach($usersCollection as $user)
        <div class="swipe-card">
            <img src="{{ URL::to('/') }}{{$user->imageUrl}}">
            <h2>{{$user->name}}</h2>
            <a href="{{URL::to('swiperight', array($user->id, $concert_id))}}">Yes</a><a href="{{URL::to('swipeleft',  array($user->id, $concert_id))}}">No</a>
        </div>
    @endforeach
@endsection