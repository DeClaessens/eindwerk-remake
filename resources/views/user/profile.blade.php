@extends('layouts.app')

@section('content')
    <div class="full-page">
        <div class="grid-container">
            <div class="user-profile-container">
                <div class="user-container">
                    <div class="user-card">
                        <div class="user-card-image" style="background: url('{{$user->imageUrl}}') center center no-repeat; background-size: cover;">

                        </div>
                    </div>
                    <ul>
                        <li class="user-info-container">
                            <h4>Name</h4>
                            <p>{{$user->voornaam}}</p>
                        </li>
                        <li class="user-info-container">
                            <h4>Bio</h4>
                            <p>{{$user->bio}}</p>
                        </li>
                        <li class="user-info-container">
                            <h4 class="favorite-artists-header">Favorite Artists</h4>
                            <p class="favorite-artists-artists">{{$user->favoriteArtists}}</p>
                        </li>
                        <li>
                            <a href="{{ url('/verifiedmatch/delete', $user->id) }}">Delete this Match</a>
                        </li>
                        <li>
                            <a href="{{ url('/chat/solo', $user->id) }}">Send a Message</a>
                        </li>
                    </ul>
                </div>
                <div class="matched-concerts-container">
                    <div class="matched-concerts-header">
                        <h2>Concerts you're matched for</h2>
                    </div>
                    <ul>
                        @foreach($concertsMatched as $concert)
                            <li class="matched-concert">
                                <a href="{{ url('concert/select', $concert->MatchedConcert->id) }}">
                                    <div class="matched-concert-image" style="background: url('{{$concert->MatchedConcert->concertImageUrl}}') center center no-repeat; background-size: cover;">

                                    </div>
                                    <div class="matched-concert-text">
                                        <p>{{$concert->MatchedConcert->name}}</p>
                                        <p>{{$concert->MatchedConcert->venue}}</p>
                                        <p>{{$concert->MatchedConcert->date->format('d/m/Y')}}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                            @foreach($concertsMatched as $concert)
                                <li class="matched-concert">
                                    <a href="{{ url('concert/select', $concert->MatchedConcert->id) }}">
                                        <div class="matched-concert-image" style="background: url('{{$concert->MatchedConcert->concertImageUrl}}') center center no-repeat; background-size: cover;">

                                        </div>
                                        <div class="matched-concert-text">
                                            <p>{{$concert->MatchedConcert->name}}</p>
                                            <p>{{$concert->MatchedConcert->venue}}</p>
                                            <p>{{$concert->MatchedConcert->date->format('d/m/Y')}}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                            @foreach($concertsMatched as $concert)
                                <li class="matched-concert">
                                    <a href="{{ url('concert/select', $concert->MatchedConcert->id) }}">
                                        <div class="matched-concert-image" style="background: url('{{$concert->MatchedConcert->concertImageUrl}}') center center no-repeat; background-size: cover;">

                                        </div>
                                        <div class="matched-concert-text">
                                            <p>{{$concert->MatchedConcert->name}}</p>
                                            <p>{{$concert->MatchedConcert->venue}}</p>
                                            <p>{{$concert->MatchedConcert->date->format('d/m/Y')}}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                            @foreach($concertsMatched as $concert)
                                <li class="matched-concert">
                                    <a href="{{ url('concert/select', $concert->MatchedConcert->id) }}">
                                        <div class="matched-concert-image" style="background: url('{{$concert->MatchedConcert->concertImageUrl}}') center center no-repeat; background-size: cover;">

                                        </div>
                                        <div class="matched-concert-text">
                                            <p>{{$concert->MatchedConcert->name}}</p>
                                            <p>{{$concert->MatchedConcert->venue}}</p>
                                            <p>{{$concert->MatchedConcert->date->format('d/m/Y')}}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                            @foreach($concertsMatched as $concert)
                                <li class="matched-concert">
                                    <a href="{{ url('concert/select', $concert->MatchedConcert->id) }}">
                                        <div class="matched-concert-image" style="background: url('{{$concert->MatchedConcert->concertImageUrl}}') center center no-repeat; background-size: cover;">

                                        </div>
                                        <div class="matched-concert-text">
                                            <p>{{$concert->MatchedConcert->name}}</p>
                                            <p>{{$concert->MatchedConcert->venue}}</p>
                                            <p>{{$concert->MatchedConcert->date->format('d/m/Y')}}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                            @foreach($concertsMatched as $concert)
                                <li class="matched-concert">
                                    <a href="{{ url('concert/select', $concert->MatchedConcert->id) }}">
                                        <div class="matched-concert-image" style="background: url('{{$concert->MatchedConcert->concertImageUrl}}') center center no-repeat; background-size: cover;">

                                        </div>
                                        <div class="matched-concert-text">
                                            <p>{{$concert->MatchedConcert->name}}</p>
                                            <p>{{$concert->MatchedConcert->venue}}</p>
                                            <p>{{$concert->MatchedConcert->date->format('d/m/Y')}}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection