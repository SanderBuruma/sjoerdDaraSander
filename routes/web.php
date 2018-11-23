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

// function isRole($roleId) {
// 	//check if user has a specific role with ID $roleId
// 	$isRole = false;
// 	foreach(Auth::user()->roles as $role){
// 		if ($role->id == $roleId) {$isRole = true; break;}
// 	}
// 	dd($roleId);
// 	return $isRole;
// }


Route::get('/', function () { return view('home'); });
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function(){ return view('pages.about'); })->name('about');

// Route::get('/admin', function() {
// 	dd('checkadmin');
// 	if (isRole(1)){
// 		dd('is admin');
// 	}
// });

Route::group(['middleware' => ['web','auth']], function(){
	Route::resource('/admin', 'AdminInterfaceController')->middleware('check.admin');
});

Auth::routes();

