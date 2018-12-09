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

// TEMP CODE
use App\User;

Route::get('/geotest', function(){
	$users = User::all();
	return view('user.geotest')->withUsers($users);
});
// TEMP CODE


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function(){ return view('pages.about'); })->name('about');


Route::group(['middleware' => ['web','auth','verified', 'role:!4']], function(){

	Route::group(['middleware' => ['role:3']], function(){
		Route::resource('/admin', 'AdminInterfaceController');
		Route::get('/adminajax', 'AdminInterfaceController@indexAjax')->name('admin.index.ajax');
	});
	
	Route::group(['middleware' => ['role:1']], function(){
		Route::resource('message', 'MessagesController');
		Route::post('message', ['as' => 'message.namedcreate', 'uses'=>'MessagesController@namedCreate']);
		Route::post('message.store', ['as' => 'message.store', 'uses'=>'MessagesController@store']);
		Route::get('/messageajax', 'MessagesController@indexAjax')->name('message.index.ajax');
		// Route::get('message/{name}/create', 'MessagesController@namedCreate');
		Route::resource('advertentie' , 'AdvertentieController', ['except' => ['show']]);
	});
	
	Route::resource('/user', 'UserInterfaceController');

});

Route::group(['middleware' => ['web']], function(){
	Route::post('advertenties.search.index', ['as' => 'advertenties.search.index', 'uses'=>'AdvertentiesSearchController@homeSearch']);
	Route::get('advertentie/{slug}', 'AdvertentieController@show')->name('advertentie.show');
});

Auth::routes(['verify' => true]);

