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

Route::get('/', 'CurrencyController@index')->name('home');

Route::get('/currencies', 'CurrencyController@index')->name('currencies');
Route::get('/currency/{code}', 'CurrencyController@show')->name('currency.show');
Route::post('/currency', 'CurrencyController@store')->name('currency.create');
Route::put('/currency/{code}', 'CurrencyController@update')->name('currency.update');
Route::delete('/currency/{code}', 'CurrencyController@destroy')->name('currency.delete');

Route::get('/history', 'CurrencyController@history')->name('history');
