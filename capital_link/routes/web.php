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

use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'TransactionController@index')->name('home');
Route::get('/transactions/create', 'TransactionController@create')->name('transactions');
Route::post('/transactions', 'TransactionController@store')->name('transactions.create');
Route::delete('/transactions/destroy{transaction}', 'TransactionController@destroy')->name('transactions.destroy');
Route::get('/transactions/edit{transaction}', 'TransactionController@edit')->name('transactions.edit');
Route::put('/transactions/update{transaction}', 'TransactionController@update')->name('transactions.update');


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
