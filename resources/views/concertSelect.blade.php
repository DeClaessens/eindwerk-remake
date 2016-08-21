@extends('layouts.app')

@section('content')

    <div class="full-page concerts-container">
        <div class="grid-container">
            <div class="concert-header">
                <h1>Find a concert!</h1>
                <h2>Look for a concert you'd like to go to</h2>
                <div class="search search-concerts">
                    <input type="search" id="searchinput" name="searchinput">
                    <div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                </div>
            </div>
            <ul class="concert-list">
                @foreach($concerts as $concert)
                    <a href="{{URL::to('concert/select', $concert->id)}}" class="column concert-list-item">
                        <div class="concert-image-container" style="background: url('{{$concert->concertImageUrl}}'), url('{{asset('img/default.jpg')}}');
                                background-size: cover;"></div>
                        <div class="concert-info">
                            <p class="concert-info-left">{{str_limit($concert->name, $limit = 20, $end = '...')}}</p>
                            <p class="concert-info-right">{{$concert->venue}} - {{$concert->date->format('d/m/Y')}}</p>
                        </div>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>

    <!--
    <div class="full-page concert-select-wrapper">
        <h1>Selecteer het concert waar je mensen voor zoekt.</h1>
        <ul class="concert-list container">
            @foreach($concerts as $concert)
                    <a href="{{URL::to('concert/select', $concert->id)}}" class="column concert-list-item" style="
                    background: url('{{$concert->concertImageUrl}}'), url('{{asset('img/default.jpg')}}');
                    background-size: 100%;">
                        <div class="concert-info">
                            <p class="concert-info-left">{{$concert->name}}</p>
                            <p class="concert-info-right">{{$concert->venue}} - {{$concert->date}}</p>
                        </div>
                    </a>
            @endforeach
        </ul>
    </div>
    -->
@endsection