<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/',function(){
	return Redirect::to('account/home');
});
Route::controller('auth','AuthController');
Route::controller('account','GuiController');
Route::resource('contact','ContactController',['only'=>['index','store','destroy','show','update']]);
Route::resource('contactNote','ContactNoteController',['only'=>['index','store']]);
Route::resource('company','CompanyController',['only'=>['index','store','destroy','show','update']]);
Route::resource('companyNote','CompanyNoteController',['only'=>['index','store']]);
Route::resource('user','UserController',['only'=>['index','store','destroy','show','update']]);