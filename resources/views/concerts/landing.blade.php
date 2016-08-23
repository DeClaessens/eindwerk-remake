@extends('layouts.app')

@section('content')
    <div class="full-page">
        <div class="grid-container">
            <div class="concert-landing-container">
                <div class="concert-landing-card">
                    <div class="concert-landing-image" style="background: url('{{$selectedConcert->concertImageUrl}}') center center no-repeat; background-size: cover;">
                        <h1>{{$selectedConcert->name}}</h1>

                        <a style="display: block" href="{{URL::to('concert/find/solo', $selectedConcert->id)}}" class="landing-button">Find People</a>
                        <div class="userconcert-toggle">
                            <div class="inner-userconcert-toggle">
                            </div>
                            <p class="userconcert-toggle-text-left">Yes</p>
                            <p class="userconcert-toggle-text-right">No</p>
                        </div>
                    </div>
                    <div class="top-tracks-container">
                        <h2>Top Tracks</h2>
                        <ul>
                            @if($topTracks != '')
                                @foreach($topTracks->tracks as $track)
                                <li>
                                    <audio id="track-{{$track->id}}">
                                        <source src="{{$track->preview_url}}" type="audio/mpeg">
                                    </audio>

                                    <a target="_blank" href="http://open.spotify.com/track/{{$track->id}}">
                                        <i class="fa fa-play-circle" aria-hidden="true" data-trackid="track-{{$track->id}}"></i>
                                        <p>{{$track->name}}</p>
                                    </a>
                                </li>
                                @endforeach
                            @else
                                <p>No Spotify Data was found for this artist.</p>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="concert-info-container">
                    <h2>About the Concert</h2>
                    <ul>
                        <li>Venue: {{$selectedConcert->venue}}</li>
                        <li>Date: {{$selectedConcert->date->format('d/m/Y')}}</li>
                        <li>GoCon Users: {{$amountOfUsers}}</li>
                        <li><a href="{{$selectedConcert->concertUrl}}">More Info & Tickets</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection