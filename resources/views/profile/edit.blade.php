@extends('layouts.app')

@section('content')
    <div class="full-page">
        <div class="grid-container">
            <div class="edit-profile-form-container">
                {!! Form::model($user, array('url' => 'profile/save', 'files' => 'true')) !!}
                <ul>
                    <li>
                        <h2> Edit Profile Info </h2>
                    </li>
                    <li class="upload-photo-li">
                        <label for="imageUrl">Profile Image</label>
                        <div class="current-profile-image" style="background: url('{{$user->imageUrl}}') center center no-repeat; background-size: cover;">
                            <p>Current Image</p>
                        </div>
                        <div class="custom-upload-button">
                            <a>Upload</a>
                        </div>

                        <div class="uploaded-profile-image">
                            <p>Uploaded Image</p>
                        </div>
                        {!! Form::file('imageUrl', array('class' => 'image-upload')) !!}

                    </li>
                    <li>
                        {!! Form::label('bio', 'Een Korte Bio') !!}
                        {!! Form::textarea('bio') !!}
                    </li>
                    <li>
                        {!! Form::label('favoriteArtists', 'Jouw favoriete Artiesten') !!}
                        {!! Form::textarea('favoriteArtists') !!}
                    </li>
                    <li class="submit-form-li">
                        {!! Form::submit('Submit changes') !!}
                    </li>
                </ul>

                {!! Form::close() !!}
            </div>
        </div>

    </div>



    <!--save form info pings back to controller at the 'save' method, parses the data from the form and then saves it to the database.
        -> returns to profile
    -->
@endsection