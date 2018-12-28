<?php

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/home', 'PagesController@index');
Route::get('/browse', 'PagesController@browse');

Route::resource('/smokes', 'SmokeController');
Route::resource('/users', 'UserController');

Route::get('/admin/approve', 'SmokeController@approve');
