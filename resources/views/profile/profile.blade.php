@extends('layouts.app')

@section('content')
<div class="full-page">
    <div class="grid-container">
        <div class="profile-position-container">
            <div class="hub-container container">
                <div class="hub-menu-item center-text">
                    <p>Welcome to GoCon!</p>
                    <p class="small">Press 'Find a Concert' to get started!</p>
                </div>
                <div class="hub-menu-item center-text">
                    <a class="hub-menu-item-link" href="/concerts">Find a Concert</a>
                </div>
                <div class="hub-menu-item recent-matches-container">
                    <p href="#" class="match-header">Most Recent Matches</p>
                    <div class="hub-recent-matches">
                        @if($fivelastmatches->isEmpty())
                            <p>You don't have any matches yet.</p>
                        @else
                                @foreach($fivelastmatches as $match)
                                    <a href="{{url('/user', $match->matchedUser->id)}}" class="recent-match-item" style="background: url('{{$match->matchedUser->imageUrl}}') center center no-repeat; background-size: cover;">
                                        <p class="name-popup">{{$match->matchedUser->name}}</p>
                                    </a>
                                @endforeach
                        @endif
                    </div>
                    <a class="more-matches" href="{{url('/matches')}}">More Matches</a>
                </div>
                <div class="hub-menu-item recent-messages-container">
                    <p href="#" class="match-header">Most Recent Messages</p>
                    <ul class="message-list">
                        @if($recentmessages->isEmpty())
                            <p id="messagesempty">You don't have any messages yet.</p>
                        @else
                            @foreach($recentmessages as $message)
                                <ul>
                                    <li>
                                        <a href="{{url('/chat/solo', $message->sender)}}" class="message-list-profile-image" style="background: url('{{$message->senderUser->imageUrl}}') center center no-repeat; background-size: cover;"></a>
                                        <a href="{{url('/chat/solo', $message->sender)}}" class="message-list-message">
                                            <p>{{str_limit($message->message, $limit = 75, $end = '...')}}</p>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        @endif
                    </ul>

                    <a class="more-matches" href="/chat">More Messages</a>
                </div>
            </div>
            <div class="profile-container container">
                <div class="profile-menu-item main-profile-menu-item">
                    <div class="profile-menu-item-image" style="background: url('{{$user->imageUrl}}') center center no-repeat; background-size: cover;">

                    </div>
                    <p>Your Profile</p>
                </div>
                <div class="profile-menu-item">
                    <a href="/matches">Matches</a>
                </div>
                <div class="profile-menu-item">
                    <a href="/chat">Messages</a>
                </div>
                <div class="profile-menu-item">
                    <a href="#">Edit Profile</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection