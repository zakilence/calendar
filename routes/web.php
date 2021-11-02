<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/events', 'EventController@index')->name('index');
Route::post('/events','EventController@create')->name('create');
Route::delete('/events/{event}','EventController@delete')->name('delete');


Route::get('/calendars','CalendarController@index')->name('index');
Route::post('/calendars','CalendarController@create')->name('create');
Route::put('/calendars/{calendar}','CalendarController@update')->name('update');
Route::delete('/calendars/{calendar}','CalendarController@delete')->name('delete');

Route::get('/groups','GroupController@index')->name('index');
Route::post('/groups','GroupController@create')->name('create');


