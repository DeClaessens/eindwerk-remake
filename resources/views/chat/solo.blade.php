@extends('layouts.app')
@section('content')
    <div class="full-page">
        <div class="grid-container">
            <div class="chat-box">
                <div class="recipient-box">
                    <a href="{{ url('/user', $otherUser->id) }}">
                        <div class="recipient-image" style="background: url('{{$otherUser->imageUrl}}') center center no-repeat; background-size: cover;">

                        </div>
                        <p>{{$otherUser->name}}</p>
                    </a>
                </div>
                <div class="message-box">
                    <ul>
                        @if($prevUser = "")@endif
                        @foreach($messages as $message)
                            @if($classlist = "")@endif
                                @if($message->senderUser->id == Auth::user()->id)
                                    <?php $classlist .= "auth" ?>
                                @else
                                    <?php $classlist .= "no-auth" ?>
                                @endif

                                @if($message->senderUser->id != $prevUser)
                                    <?php $classlist .= " first" ?>
                                @endif

                            <li class="<?php echo $classlist ?>">
                                <div class="message-inner-wrapper">
                                    <div class="profile-image" style="background: url('{{$message->senderUser->imageUrl}}') center center no-repeat; background-size: contain">
                                        <a href="{{ url('/user', $otherUser->id) }}"></a>
                                    </div>
                                    <p>{{$message->message}}</p>
                                    <div class="nofloat"></div>
                                </div>
                                <div class="timestamp">
                                    <p>{{$message->created_at->format('d/m/Y H:m')}}</p>
                                    <div class="nofloat"></div>
                                </div>
                            </li>

                                <?php $prevUser = $message->senderUser->id;
                                ?>
                        @endforeach
                    </ul>
                </div>
                <div class="input-box">
                    {!! Form::open(array('url' => array('chat/solo/send', $otherUser->id))) !!}
                    {!! Form::text('message') !!}
                    {!! Form::submit('submit') !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="matched-concerts-container">
                <div class="matched-concerts-header">
                    <h2>Concerts you're matched for</h2>
                </div>
                <ul>
                    @foreach($matchedConcerts as $concert)
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
@endsection