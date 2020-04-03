<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('home.index');
})->name('home');

Route::get('/board', 'BoardController@index')->name('board');

Route::get('/login', 'Auth\SecurityController@redirectToProvider')->name('login');
Route::get('/login/callback', 'Auth\SecurityController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', 'Auth\SecurityController@logout')->name('logout');

    Route::get('/mypage', 'MypageController@index')->name('mypage');

    Route::post('/mypage/tasks/create', 'TaskController@create')->name('tasks.create');
    Route::get('/mypage/dates/create', 'DateController@create')->name('dates.create');

    Route::group(['middleware' => 'can:update,task'], function() {
        Route::post('/mypage/tasks/{task}/change_status', 'TaskController@changeStatus')->name('tasks.changeStatus');
        Route::post('/mypage/tasks/{task}/delete', 'TaskController@delete')->name('tasks.delete');
    });

    Route::get('/mypage/tweet', 'TweetController@index')->name('tweet.index');
    Route::get('mypage/tweet/confirm', function () {
        return redirect()->route('tweet.index')->with('message', '予期せぬエラーが起きました。');
    });
    Route::post('/mypage/tweet/confirm', 'TweetController@tweetConfirm')->name('tweet.confirm');
    Route::post('/mypage/tweet/tweet', 'TweetController@tweet')->name('tweet.tweet');

    Route::get('/mypage/config', 'UserConfigController@index')->name('config.index');
    Route::post('/mypage/config/save', 'UserConfigController@save')->name('config.save');
});
