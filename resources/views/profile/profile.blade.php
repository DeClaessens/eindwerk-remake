@extends('layouts.app')

@section('content')
    <div class="profile-container">
        <div class="profile-image" style="background-image: url({{ URL::to('/') }}{{$user->imageUrl}})"></div>
        <h1>{{$user->name}}</h1>

        <!-- this should eventually link to certain different user profiles 'anyone' can lookup -->
        <p>Dit zijn jouw matches!</p>

        <div class="matched-user-container">
            @foreach($matchedusers as $match)
                <div class="matched-user">
                    <a class="matched-user-image" href="{{URL::to('user', $match->id)}}" style="background: url({{ URL::to('/') }}{{$match->imageUrl}}); background-position: center center; background-size: cover; background-repeat: no-repeat;"></a>
                    <a class="matched-user-name" href="{{URL::to('user', $match->id)}}">{{$match->name}}</a>
                </div>
            @endforeach
        </div>

        <div class="profile-buttons">
            <a href="{{URL::to('profile/edit')}}">Edit Profile Info</a>
            <a href="{{URL::to('concerts')}}">Select a concert to start</a>
        </div>
    </div>
@endsection