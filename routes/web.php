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

Route::get('/', 'SiteController@index')->name('home');
Route::get('/category/{category}/posts', 'SiteController@categoryProducts')->name('category.products');
Route::get('/sub-category/{category}/{subCategory}/posts', 'SiteController@subCategoryProducts')->name('subCategory.products');
Route::get('/categories/tur-advertencia/posts', 'SiteController@allCategoryProducts')->name('all.category.products');
Route::get('/search', 'SiteController@postSearch')->name('post.search');

//
Route::get('/filer/{category?}/{sub-category?}', 'SiteController@filerPosts')->name('filter.posts');


Route::get('/post/create', 'PostController@create')->name('post.create');
Route::get('/post/{post}/details', 'PostController@show');
Route::post('/post/store', 'PostController@store')->name('post.store');

//for shorting

Route::get('/ca/{category?}/{subCategory?}', 'SiteController@shortProducts')->name('short.products');
//route for delete the post
Route::get('/destroy/{id}/{title}/{email}/{expire_date}', 'PostController@deletePost');
Route::get('/post/destroy/{id}/{title}/{email}/{expire_date}', 'PostController@confirmDeletePost');

//for check if mail is working or not
Route::get('/sendMail/{post}', 'PostController@sendMail');