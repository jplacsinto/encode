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

Route::get('/', function () {
    return redirect()->route('articles.index');
    //return view('welcome');
});


Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');


Route::middleware('auth')->group(function(){

	Route::resource('users', 'UsersController')->middleware('can:manage-users');

	Route::resource('sections', 'SectionController')->middleware('can:manage-sections');

	Route::resource('articles', 'ArticleController')->middleware('can:manage-articles');
	
});

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});Route::resource('roles', 'RoleController');