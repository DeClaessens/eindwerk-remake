@extends('layouts.app')

@section('content')
    <h1>Edit page</h1>


    {!! Form::open(array('url' => 'profile/save', 'files' => 'true')) !!}
        {!! Form::label('bio', 'Een Korte Bio') !!}
        {!! Form::textarea('bio', '') !!}

        {!! Form::label('favoriteArtists', 'Jouw favoriete Artiesten') !!}
        {!! Form::textarea('favoriteArtists', '') !!}

        {!! Form::file('imageUrl') !!}


        {!! Form::submit('Submit changes') !!}

    {!! Form::close() !!}

    <!--save form info pings back to controller at the 'save' method, parses the data from the form and then saves it to the database.
        -> returns to profile
    -->
@endsection