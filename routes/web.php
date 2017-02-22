<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'namespace' => 'Admin'], function(){
    Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);

    // Gallery Route
    Route::resource('/gallery', 'GalleryController', ['names' => 'admin.gallery']);
    Route::get('/gallery/{id}/image', ['as' => 'admin.image.create', 'uses' => 'GalleryController@getFormImage']);
    Route::post('/gallery/{id}/image', ['as' => 'admin.image.upload', 'uses' => 'GalleryController@doUploadImage']);
    Route::delete('/gallery/{id}/image', ['as' => 'admin.image.destroy', 'uses' => 'GalleryController@doImageDestroy']);
});
