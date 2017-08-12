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

/*Route::get('/', function () {
    return view('blog.index');
});*/

Route::get('/',[
    'uses'=>'BlogController@getIndex',
    'as'=>'blog.index'
]);
Route::get('/blog/{post}',[
    'uses'=>'BlogController@getShow',
    'as'=>'blog.show'
]);

Route::get('/category/{category}',[
    'uses'=>'BlogController@getCategory',
    'as'=>'blog.category'
]);

Route::get('/author/{author}',[
    'uses'=>'BlogController@getAuthor',
    'as'=>'blog.author'
]);
Route::auth();

Route::get('/home', 'backend\HomeController@index');

Route::resource('/backend/blog','backend\BlogController');

Route::post('/backend/blog/delete-for-ever/{id}',[
    'uses'=>'backend\BlogController@deleteForEver',
    'as'=>'deleteForEver'
]);

Route::post('/backend/blog/restore/{id}',[
    'uses'=>'backend\blogController@restore',
    'as'=>'restore'
]);

// --- Category -------

Route::resource('backend/category','backend\CategoryController');

// --- User -------
Route::resource('backend/user','backend\UserController');

Route::get('/backend/user/confirm/{id}',[
    'uses'=>'backend\UserController@confirm',
    'as'=>'user.confirm'
]);