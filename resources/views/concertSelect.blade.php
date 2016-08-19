@extends('layouts.app')

@section('content')
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
@endsection