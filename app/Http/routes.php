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

// Route::get('/', 'WelcomeController@index');
Route::get('/','HomeController@index');
Route::get('home', ['as' =>'home','uses'=>'HomeController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::post('members/store',['as'=>'members.store','uses'=>'MemberController@store']);
Route::resource('members', 'MemberController');
Route::get('roles',['as'=>'roles','uses'=>'RoleController@index']);
Route::get('roles_modal/{id}',['as'=>'roles_modal','uses'=>'RoleController@modal']);
// role_permissions
Route::get('role_permissions',['as'=>'role_permissions','uses'=>'RoleController@role_permissions']);

//--------------- Start config route for statistics module ---------------//
Route::get('showchart',['as'=>'showchart','uses'=>'Statistics\StatisticsController@showChart']);
Route::get('getchartdata',['as'=>'getchartdata','uses'=>'Statistics\StatisticsController@getChartData']);
//--------------- Start config route for statistics module ---------------//	

//--------------- Start config route for settings module ---------------//
//Route::get('showcustomattr',['as'=>'showcustomattr','uses'=>'Settings\UserSettingsController@showUserCustom']);
Route::post('customsetting/store',['as'=>'customsetting.store','uses'=>'Settings\UserSettingsController@store']);
Route::resource('customsetting', 'Settings\UserSettingsController');
//--------------- Start config route for settings module ---------------//
