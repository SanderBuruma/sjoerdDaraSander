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

Route::group(['middleware' => ['web','auth','role:3']], function(){
	Route::resource('/admin', 'AdminInterfaceController');
	Route::get('/adminajax', 'AdminInterfaceController@indexAjax')->name('admin.index.ajax');
});

Auth::routes(['verify' => true]);


Route::resource('/adverts', 'PostsController');
// Route::get('/create', function () {
//     return view('adverts.create');
// });


// Route::get('post', 'PostsController@index');
// Route::post('post', 'PostsController@create');
// Route::post('delete','PostsController@delete');
// Route::post('update','PostsController@update');