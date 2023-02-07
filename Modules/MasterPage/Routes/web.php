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


Route::group(['middleware' => ['auth']], function() {
    Route::resource('masterpage', 'MasterPageController');
    Route::post('masterpage/filter', 'MasterPageController@index');
    Route::post('masterpage/export', 'MasterPageController@export')->name('masterpage.export');
    });