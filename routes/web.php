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

Route::get('/', 'WelcomeController@index');

/*
 * Authentication
 */
Route::get('auth/login', 'Auth\LoginController@login');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');

/*
 * Computer
 */
Route::resource('computer', 'ComputerController');

Route::get('computer/{computer}/boot', 'ComputerController@boot');

Route::get('computer/{computer}/status', 'ComputerController@status');
