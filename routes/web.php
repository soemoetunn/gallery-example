<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');
Route::post('/','HomeController@store')->name('home.store');
Route::get('/{id}/delete','HomeController@destroy')->name('home.destroy');
Route::get('/{id}/download','HomeController@download')->name('home.download');
