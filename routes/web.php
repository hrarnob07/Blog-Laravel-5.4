<?php


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post','PostController@post');
Route::get('/profile','ProfileController@profile');
Route::get('/catagory','CategoryController@category');
Route::post('/addcategory','CategoryController@addcategory');
Route::post('/addprofile','ProfileController@addprofile');
Route::post('/addpost','PostController@addpost');
Route::get('/view/{id}','PostController@view');
Route::get('/edit/{id}','PostController@edit');
Route::post('/editpost/{id}','PostController@editpost');
Route::get('delete/{id}','PostController@delete');
Route::get('/category/{id}','PostController@category');
Route::get('/like/{id}','PostController@like');
Route::get('/dislike/{id}','PostController@dislike');
Route::post('/comment/{id}','PostController@comment');
Route::post('/search','PostController@search');

