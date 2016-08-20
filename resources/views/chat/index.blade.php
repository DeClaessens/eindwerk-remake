@extends('layouts.app')
@section('content')
    <div class="full-page">
        <div class="grid-container">
            <div class="chat-overview-container">
                <div class="chat-overview-header">
                    <h3>All Chat Threads</h3>
                </div>
                <ul class="chat-threads">
                    @if(count($uniqueVerifiedMatchArray) > 0)
                    @for($i = 0; $i < count($uniqueVerifiedMatchArray); $i++)
                        <li class="thread">
                            <a href=" {{ url('chat/solo', $uniqueVerifiedMatchArray[$i]->MatchedUser->id) }}">
                                <div class="thread-profile-image" style="background: url('{{$uniqueVerifiedMatchArray[$i]->MatchedUser->imageUrl}}') center center no-repeat; background-size: cover;">

                                </div>
                                <div class="thread-tekst">
                                    <p class="thread-tekst-name">
                                        {{str_limit($uniqueVerifiedMatchArray[$i]->MatchedUser->name, $limit = 70, $end = '...')}}
                                    </p>
                                    <p class="thread-tekst-message">
                                        @if($lastMessageArray[$i]['message'] != '')
                                        {{str_limit($lastMessageArray[$i]->message, $limit = 100, $end = '...')}}
                                        @else
                                            No Messages yet! Be the first to say 'Hello!'
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </li>
                    @endfor
                    @else
                        <p class="no-matches-found">You don't have any Matches yet. Get swiping to start chatting!</p>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection