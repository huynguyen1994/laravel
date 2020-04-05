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

Route::get('/', 'LoginController@index')->name('login');
Route::post('post-login', 'LoginController@store');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::group([ 'middleware' => 'adminMiddleware','prefix' => 'backend', 'namespace' => 'Backend'], function() {
    Route::get("/", "DashBoardController@index")->name("backend.dashboard");
    Route::get("users", 'UsersController@index')->name("backend.users.index");
});
Route::get('login/facebook', 'LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'LoginController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
