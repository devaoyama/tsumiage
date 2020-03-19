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

Route::get('/login', 'Auth\SecurityController@redirectToProvider');
Route::get('/login/callback', 'Auth\SecurityController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', 'Auth\SecurityController@logout');
    Route::get('/mypage', 'MypageController@index')->name('mypage');
    Route::get('/mypage/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/mypage/tasks/create', 'TaskController@create');
    Route::get('/mypage/tasks/{id}/change_status', 'TaskController@changeStatus')->name('tasks.changeStatus');
    Route::get('/mypage/tasks/{id}/delete', 'TaskController@delete')->name('tasks.delete');
});

