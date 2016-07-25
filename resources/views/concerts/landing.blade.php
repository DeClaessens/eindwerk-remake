@extends('layouts.app')

@section('content')
    <div class="concert-landing-container">
        <div class="concert-landing-image" style="background-image: url({{$selectedConcert->concertImageUrl}})"></div>
        <h1>{{$selectedConcert->name}}</h1>
        <a style="display: block" href="{{URL::to('concert/find/solo', $selectedConcert->id)}}" class="landing-button">Find someone to go with</a>
        <a style="display: block" href="{{URL::to('concert/find/group', $selectedConcert->id)}}" class="landing-button">Find a group to go with</a>
        <a style="display: block" href="{{URL::to('concert/search', $selectedConcert->id)}}" class="landing-button">Search for someone to join your group</a>
    </div>

@endsection