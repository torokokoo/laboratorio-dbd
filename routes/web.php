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

Route::get('/', function () {
  return view('welcome');
});
Route::get('/currencies', 'CurrencyController@index');
Route::get('/currencies/{id}', 'CurrencyController@show');
Route::post('/currency/create', 'CurrencyController@store');
Route::put('/currency/update/{id}', 'CurrencyController@update');

Route::get('/genders', 'GenderController@index');
Route::get('/genders/{id}', 'GenderController@show');
Route::post('/gender/create', 'GenderController@store');
Route::put('/gender/update/{id}', 'GenderController@update');

Route::get('/demos', 'DemoController@index');
Route::get('/demos/{id}', 'DemoController@show');
Route::post('/demo/create', 'DemoController@store');
Route::put('/demo/update/{id}', 'DemoController@update');

Route::get('/transactions', 'TransactionController@index');
Route::get('/transactions/{id}', 'TransactionController@show');
Route::post('/transaction/create', 'TransactionController@store');
Route::put('/transaction/update/{id}', 'TransactionController@update');

Route::get('/age_restricions', 'AgeRestrictionController@index');
Route::get('/age_restricions/{id}', 'AgeRestrictionController@show');
Route::post('/age_restricion/create', 'AgeRestrictionController@store');
Route::put('/age_restricion/update/{id}', 'AgeRestrictionController@update');
