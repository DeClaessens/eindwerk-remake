@extends('layouts.app')

@section('content')
    <div class="full-page">
        <div class="grid-container">
            <div class="swipe-outer-container">
                <div class="current-concert">
                    <ul>
                        <li>
                            <h2>Current Concert</h2>
                        </li>
                        <li class="image-name-concert-container">
                            <img src="{{$concert->concertImageUrl}}">
                            <div class="text-container">
                                <p>{{$concert->name}}</p>
                                <p>{{$concert->venue}}</p>
                                <p>{{$concert->date->format('d/m/Y')}}</p>
                            </div>
                        </li>
                        <li class="more-info-concert-container">
                            <a target="_blank" href="{{$concert->concertUrl}}">More Info</a>
                        </li>
                    </ul>
                </div>

                <div class="swipe-container">
                    <h2>Swipin' Time!</h2>
                    <h4>Find people you like! Left means 'no', Right means 'yes'!</h4>
                    <div id="tinderslide">
                        <ul>
                            <input type="hidden" class="csrf" value="{!! csrf_token() !!}">
                            <?php $counter = 1; ?>
                            @foreach($usersCollection as $user)
                                <li class="swipe-card" data-userid="{{$user->id}}" data-concertid="{{$concert_id}}">
                                    <div class="image-container">
                                        <div class="like-dislike-notification"></div>
                                        <img src="{{$user->imageUrl}}">
                                    </div>
                                    <div class="text-container">
                                        <h2>{{$user->voornaam}}</h2>
                                        <p>{{$user->bio}}</p>
                                        <!--
                                        <a href="#" class="swipe-button dislike-button">Dislike</a>
                                        <a href="#" class="swipe-button like-button">Like</a>
                                        -->
                                    </div>

                                    <!--<a href="{{URL::to('swiperight',  array($user->id, $concert_id))}}">Yes</a><a href="{{URL::to('swipeleft',  array($user->id, $concert_id))}}">No</a>-->
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <a href="{{url('/concerts')}}" class="no-more-people-found">
                        <p>We can't find anyone else. Click to find another concert</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascripts')
    <script>
        var SwipeListItemCounter = 0;
        var swipes = 0;
        SwipeListItemCounter = checkList();
        displayNoMoreSwipesDiv(checkIfAllSwiped());
        $("#tinderslide").jTinder({
            onDislike: function (item) {
                displayNoMoreSwipesDiv(checkIfAllSwiped());
            },
            onLike: function (item) {
                displayNoMoreSwipesDiv(checkIfAllSwiped());
                var token = $('.csrf').val();
                $.post(
                        '/swiperight/' + item.data('userid') + '/' + item.data('concertid'),
                        {
                            "_token": token
                        }
                );
            },
            likeSelector: '.like',
            dislikeSelector:  '.dislike'
        });

        /*$('.like-button, .dislike-button').click(function(e){
            e.preventDefault();
            console.log('hello');
            $("#tinderslide").jTinder($(this).attr('class'));
            e.stopPropagation();
        });

        $('.like-button').on('click', function(e) {

        });

        $('.dislike-button').on('click', function() {
            console.log('hello');
            displayNoMoreSwipesDiv(checkIfAllSwiped());
        });*/

        function checkList() {
            var counter = 0;
            $('#tinderslide ul li').each(function(){
                counter++;
            });


            return counter
        }

        function checkIfAllSwiped() {
            if(swipes < SwipeListItemCounter) {
                swipes++;
                return false
            } else {
                swipes++;
                return true;
            }

        }

        function displayNoMoreSwipesDiv(allswiped) {
            console.log(allswiped);
            if(allswiped) {
                $('#tinderslide').css('display', 'none');
                $('.no-more-people-found').css('display', 'block');
            }
        }

    </script>
@endsection