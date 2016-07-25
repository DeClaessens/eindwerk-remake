@extends('layouts.app')

@section('content')
    <h1>Selecteer het concert waar je mensen voor zoekt.</h1>
    <ul class="concert-list container">
        @foreach($concerts as $concert)
                <a href="{{URL::to('concert/select', $concert->id)}}" class="column concert-list-item" style="
                background: url('{{$concert->concertImageUrl}}');
                background-size: 100%;">
                    <div class="concert-info">
                        <span class="concert-info-left">{{$concert->name}}</span>
                        <!--<span class="concert-info-right">{{$concert->date}}</span>-->
                    </div>
                </a>
        @endforeach
    </ul>
@endsection