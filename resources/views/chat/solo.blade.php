@extends('layouts.app')
@section('content')
    <div class="chat-box">
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
                            <div class="profile-image" style="background: url('{{$message->senderUser->imageUrl}}') center center no-repeat; background-size: contain"></div>
                            <p>{{$message->message}}</p>
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
@endsection