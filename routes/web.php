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


Route::get('/', function () { return view('pages.home'); });
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function(){ return view('pages.about'); })->name('about');

Route::group(['middleware' => ['web','auth','verified']], function(){

	Route::group(['middleware' => ['role:3']], function(){
		Route::resource('/admin', 'AdminInterfaceController');
		Route::get('/adminajax', 'AdminInterfaceController@indexAjax')->name('admin.index.ajax');
	});
	
	Route::group(['middleware' => ['role:1']], function(){
		Route::resource('message', 'MessagesController');
		Route::resource('advertentie' , 'AdvertentieController');
	});
	
	Route::resource('/user', 'UserInterfaceController');
	
});

Auth::routes(['verify' => true]);

