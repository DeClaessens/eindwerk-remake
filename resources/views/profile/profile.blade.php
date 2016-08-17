@extends('layouts.app')

@section('content')
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
                <ul>
                    @foreach($fivelastmatches as $match)
                        <li style="background: url('{{$match->matchedUser->imageUrl}}') center center no-repeat; background-size: contain;"></li>
                    @endforeach
                </ul>
            </div>

            <div class="recent-messages-screen widget">
                <h1>Your recent messages</h1>
                <ul>
                    @foreach($recentmessages as $message)
                        <li>
                            <div class="message-profile-icon" style="background: url('{{$message->senderUser->imageUrl}}') center center no-repeat; background-size: cover;"></div>
                            <p>{{$message->message}}</p>
                            <a href="#">Reply</a>
                        </li>
                    @endforeach
                </ul>
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
@endsection