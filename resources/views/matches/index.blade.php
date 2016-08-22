@extends('layouts.app')

@section('content')
    <div class="full-page">
        <div class="grid-container">
            <div class="matches-header">
                <h1>These are all your matches!</h1>
                <h2>Find a match you'd like to know more of</h2>
                <div class="search search-matches">
                    <input type="search" id="searchinput" name="searchinput">
                    <div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                </div>
            </div>
            <div class="matches-container container">
                @for($i = 0; $i < 10; $i++)
                    @if($counter = 0)@endif
                    @foreach($matches as $match)
                        <a href="{{url('user', $match->MatchedUser->id)}}"class="match">
                            <div class="match-image" style="background: url('{{$match->MatchedUser->imageUrl}}') center center no-repeat; background-size: cover;"></div>
                            <div class="match-text">
                                <p class="name matched-user">{{$match->MatchedUser->voornaam}}</p>
                                <p class="name matched-concert">You matched for {{$amountOfConcertsArray[$counter]}} concerts</p>
                            </div>
                        </a>
                        <?php $counter++ ?>
                    @endforeach
                @endfor
            </div>
        </div>
    </div>

@endsection