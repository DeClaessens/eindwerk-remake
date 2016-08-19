@extends('layouts.app')

@section('content')
    <div id="tinderslide">
        <ul>
            <input type="hidden" class="csrf" value="{!! csrf_token() !!}">
            <?php $counter = 1; ?>
            @foreach($usersCollection as $user)
                <li class="swipe-card" data-userid="{{$user->id}}" data-concertid="{{$concert_id}}">
                    <div class="image-container">
                        <div class="like-dislike-notification"></div>
                        <img src="{{ URL::to('/') }}{{$user->imageUrl}}">
                    </div>
                    <div class="text-container">
                        <h2>{{$user->name}}, 23</h2>
                        <p>{{$user->bio}}</p>
                    </div>

                    <!--<a href="{{URL::to('swiperight',  array($user->id, $concert_id))}}">Yes</a><a href="{{URL::to('swipeleft',  array($user->id, $concert_id))}}">No</a>-->
                </li>
            @endforeach
        </ul>
    </div>
@endsection