<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::get('/blog/{slug}', 'HomeController@details')->name('details');
Route::post('/comment-save', 'HomeController@commentSave')->name('comment-save');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/search/sorting', 'HomeController@searchSorting')->name('search-sorting');

Auth::routes([
	'reset' => false,
	'verify' => false,
]);

Route::group(['prefix' => 'dashboard'], function () {
	Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');
	
	Route::resource('/blog','Dashboard\BlogController');
	Route::put('/blog/update-status/{blog}', 'Dashboard\BlogController@updateStatus')->name('blog.update-status');
	Route::get('/blog/comments/{blog}', 'Dashboard\BlogController@comments')->name('blog.comments');
	Route::put('/blog/comments/accept/{blog}', 'Dashboard\BlogController@commentsAccept')->name('blog.comments.accept');
	Route::delete('/blog/comments/delete/{blog}', 'Dashboard\BlogController@commentsDelete')->name('blog.comments.delete');

	Route::resource('/role','Dashboard\RoleController');
	
	Route::resource('/user','Dashboard\UserController');
});

//['middleware' => 'role:super-admin']