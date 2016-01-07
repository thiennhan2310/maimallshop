<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get("/","PageController@index");
Route::get("trang-chu","PageController@index");
Route::get("san-pham/{cate}/","PageController@listProducts");
Route::get("chi-tiet/{alias}","PageController@detailProduct");

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
