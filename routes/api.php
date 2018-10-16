<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('get-topics', 'TopicController@index');
    Route::post('create-new-topic', 'TopicController@store');
    Route::post('vote-to-topic', 'TopicController@storeTopicVote');
});
