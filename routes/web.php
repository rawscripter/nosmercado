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
Auth::routes();
Route::get('/', 'SiteController@index')->name('home');
Route::get('/category/{category}/posts', 'SiteController@categoryProducts')->name('category.products');
Route::get('/sub-category/{category}/{subCategory}/posts', 'SiteController@subCategoryProducts')->name('subCategory.products');
Route::get('/categories/tur-advertencia/posts', 'SiteController@allCategoryProducts')->name('all.category.products');
Route::get('/search', 'SiteController@postSearch')->name('post.search');
Route::get('/filer/{category?}/{sub-category?}', 'SiteController@filerPosts')->name('filter.posts');
Route::get('/post/{post}/details', 'PostController@show');

Route::get('/cart', 'CartController@index');
Route::get('/cart/{post}/add', 'CartController@addToCart');
Route::get('/cart/{post}/remove', 'CartController@removeFromCart')->name('remove.from.cart');


Route::get('/post/create', 'PostController@create')->name('post.create')->middleware('auth');
Route::post('/post/store', 'PostController@store')->name('post.store')->middleware('auth');

//for shorting
Route::get('/ca/{category?}/{subCategory?}', 'SiteController@shortProducts')->name('short.products');
//route for email links [edit and delete]
Route::get('/delete/{uuid}', 'PostController@deletePost')->name('delete.user.post.from.email.url');
Route::get('/post/destroy/{uuid}', 'PostController@confirmDeletePost')->name('confirm.delete.post');
Route::get('/post/edit/{uuid}', 'PostController@editPost')->name('post.update.email.url');
Route::post('/post/update/{uuid}', 'PostController@updatePost')->name('post.update');

//for check if mail is working or not
Route::get('/sendMail/{post}', 'PostController@sendMail');

Route::get('/home', 'HomeController@home');

// routes for admin dashboard


Route::group(['middleware' => ['auth', 'role:customer']], function () {
    Route::get('/user/posts', 'CustomerController@posts')->name('customer.posts');
    Route::get('/user/profile', 'CustomerController@profile')->name('customer.profile');
    Route::post('/user/{user}/profile/update', 'CustomerController@update')->name('customer.profile.update');

});
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', 'HomeController@index')->name('admin.home');
    Route::get('/admin/loin/as/{user}', 'HomeController@loginAsCustomer')->name('admin.login.as.customer');

    Route::get('/admin/posts', 'AdminPostController@index')->name('admin.posts');
    Route::get('/admin/customers', 'CustomerController@index')->name('admin.customers');
    Route::get('/admin/customer/create', 'CustomerController@create')->name('admin.customer.create');
    Route::post('/admin/customer/store', 'CustomerController@store')->name('admin.customer.store');
    Route::delete('/admin/customer/{user}/destroy', 'CustomerController@destroy')->name('admin.customer.destroy');
    Route::get('/admin/archive/posts', 'AdminPostController@archivePosts')->name('admin.archive.posts');
    Route::get('/admin/{post}/archive', 'AdminPostController@postArchive')->name('admin.post.archive');
    Route::get('/admin/{post}/active', 'AdminPostController@postActive')->name('admin.post.active');


    Route::delete('/admin/{post}/delete', 'AdminPostController@delete')->name('admin.post.destroy');
});


//for clear site cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return 'cache cleared';
});
