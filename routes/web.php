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
    Route::get("users/create", 'UsersController@create')->name("backend.users.create");
    Route::post("users/store", 'UsersController@store')->name("backend.users.store");
    Route::get("users/destroy/{id}", 'UsersController@destroy')->name("backend.users.destroy");
    Route::get("users/edit/{id}", 'UsersController@edit')->name("backend.users.edit");
    Route::post("users/update/{id}", 'UsersController@update')->name("backend.users.update");

    Route::get('users/editProfile', 'UsersController@editProfile')->name('backend.users.editProfile');
    Route::post('users/updateProfile', 'UsersController@updateProfile')->name('backend.users.updateProfile');
});
Route::get('login/facebook', 'LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'LoginController@handleProviderCallback');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('redirect', 'LoginController@redirect');
Route::get('callback', 'LoginController@callback');
Route::get('login/line', 'LoginController@redirectToProviderLine')->name('login.line');
Route::get('login/line/callback', 'LoginController@handleProviderCallBackLine');


Route::get('/login-amp', 'LoginController@index_amp');
Route::get('/shopcart-amp', 'LoginController@shopCartAmp');
Auth::routes();
