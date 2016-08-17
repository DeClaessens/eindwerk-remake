@extends('layouts.app')

@section('content')
    <div id="tinderslide">
        <ul>
            <?php $counter = 1; ?>
            @foreach($usersCollection as $user)
                <li class="swipe-card">
                    <img src="{{ URL::to('/') }}{{$user->imageUrl}}">
                    <h2>{{$user->name}}</h2>
                    <a href="{{URL::to('swiperight', array($user->id, $concert_id))}}">Yes</a><a href="{{URL::to('swipeleft',  array($user->id, $concert_id))}}">No</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection