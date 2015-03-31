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

Route::get('/', 'WelcomeController@index');

/*
 * Authentication
 */
Route::controller('auth', 'AuthController');

/*
 * Computer
 */
Route::resource('computer', 'ComputerController');

Route::get('computer/{computer}/boot', 'ComputerController@boot');

Route::get('computer/{computer}/status', 'ComputerController@status');