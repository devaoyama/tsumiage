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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'Auth\SecurityController@redirectToProvider');
Route::get('/login/callback', 'Auth\SecurityController@handleProviderCallback');
Route::get('/logout', 'Auth\SecurityController@logout');

Route::get('/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('/tasks/create', 'TaskController@create');
