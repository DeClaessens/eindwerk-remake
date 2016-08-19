@extends('layouts.app')

@section('content')
<div class="full-page">
    <div class="grid-container">

    </div>
</div>














































        <!--
    <div id="gradient" class="full-page profile-header">

        <div class="header-inner-wrapper">
            <div class="edit-profile-button">
                <a href="{{URL::to('profile/edit')}}">Edit Profile</a>
            </div>
            <div class="profile-image" style="background: url('{{$user->imageUrl}}') center center no-repeat; background-size: contain;">
            </div>
            <div class="gotoconcerts-button">
                <a href="{{URL::to('concerts')}}">Concerts</a>
            </div>
        </div>
        <div class="widget-container">
            <div class="profile-notification-screen widget">
                <h1>Your recent matches</h1>
                @if($fivelastmatches->isEmpty())
                    <p>You don't have any matches yet.</p>
                @else
                    <ul>
                        @foreach($fivelastmatches as $match)
                            <li style="background: url('{{$match->matchedUser->imageUrl}}') center center no-repeat; background-size: cover;"></li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="recent-messages-screen widget">
                <h1>Your recent messages</h1>

                @if($recentmessages->isEmpty())
                    <p id="messagesempty">You don't have any messages yet.</p>
                @else
                    @foreach($recentmessages as $message)
                    <ul>
                        <li>
                            <div class="message-profile-icon" style="background: url('{{$message->senderUser->imageUrl}}') center center no-repeat; background-size: cover;"></div>
                            <p>{{str_limit($message->message, $limit = 35, $end = '...')}}</p>
                            <a href="{{url('/chat/solo', $message->sender)}}">Reply</a>
                        </li>
                    </ul>
                    @endforeach
                @endif

            </div>

            <div class="upcoming-concert-screen widget">
                <h1>Upcoming Concerts</h1>
                <ul>
                    @foreach($upcomingconcerts as $concert)
                        <li>
                            <p>{{$concert->name}} - {{$concert->venue}}</p>
                            <a href="{{url('/concert/select', $concert->id)}}">Go</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
    -->
@endsection