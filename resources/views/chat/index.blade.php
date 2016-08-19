@extends('layouts.app')
@section('content')
    <div class="chat-overview-box">
        <ul>
            {{dd($uniqueVerifiedMatchArray)}}
            @for($i = 0; $i < count($uniqueVerifiedMatchArray); $i++)
            <li>
                {{$uniqueVerifiedMatch[$i]->user2}}
            </li>
            @endfor
        </ul>

    </div>
@endsection