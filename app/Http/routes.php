<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/redirect', 'SocialAuthController@redirect');
    Route::get('/callback', 'SocialAuthController@callback');

    Route::get('/home', 'HomeController@index');

    Route::get('/profile', 'UserController@profile');

    Route::get('/profile/edit', 'UserController@edit');

    Route::post('/profile/save', 'UserController@saveProfile');

    Route::get('/user/{id}', 'UserController@userPage');

    Route::get('/chat/solo/{id}', 'ChatController@showChat');

    Route::post('/chat/solo/send/{id}', 'ChatController@sendMessage');

    Route::get('/concert/select/{concertId}', 'ConcertController@showConcertLanding');

    Route::get('/concerts', 'HomeController@concerts');

    Route::get('/admin/getConcerts', 'HomeController@saveConcertsToDatabase');

    Route::get('/concert/find/solo/{concertId}', 'ConcertController@findSolo');

    Route::get('/stubru', 'HomeController@stubru');

    Route::get('/swiperight/{userId}/{concertId}', 'PotentialMatchController@soloYes');
});
Route::auth();

Route::get('/home', 'HomeController@index');
