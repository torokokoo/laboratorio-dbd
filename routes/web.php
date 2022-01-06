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
Route::delete('/currenc/delete/{id}', 'CurrencyController@destroy');

Route::get('/genders', 'GenderController@index');
Route::get('/genders/{id}', 'GenderController@show');
Route::post('/gender/create', 'GenderController@store');
Route::put('/gender/update/{id}', 'GenderController@update');
Route::delete('/gender/delete/{id}', 'GenderController@destroy');

Route::get('/demos', 'DemoController@index');
Route::get('/demos/{id}', 'DemoController@show');
Route::post('/demo/create', 'DemoController@store');
Route::put('/demo/update/{id}', 'DemoController@update');
Route::delete('/demo/delete/{id}', 'DemoController@destroy');

Route::get('/transactions', 'TransactionController@index');
Route::get('/transactions/{id}', 'TransactionController@show');
Route::post('/transaction/create', 'TransactionController@store');
Route::put('/transaction/update/{id}', 'TransactionController@update');
Route::delete('/transaction/delete/{id}', 'TransactionController@destroy');

Route::get('/transaction_currencies', 'TransactionCurrencyController@index');
Route::get('/transactions_currencies/{id}', 'TransactionCurrencyController@show');
Route::post('/transaction_currency/create', 'TransactionCurrencyController@store');
Route::put('/transaction_currency/update/{id}', 'TransactionCurrencyController@update');
Route::delete('/transaction_currency/delete/{id}', 'TransactionCurrencyController@destroy');

Route::get('/age_restricions', 'AgeRestrictionController@index');
Route::get('/age_restricions/{id}', 'AgeRestrictionController@show');
Route::post('/age_restricion/create', 'AgeRestrictionController@store');
Route::put('/age_restricion/update/{id}', 'AgeRestrictionController@update');

Route::get('/comunas', 'ComunaController@index');
Route::get('/comunas/{id}', 'ComunaController@show');
Route::post('/comunas/create', 'ComunaController@store');
Route::put('/comunas/update/{id}', 'ComunaController@update');

Route::get('/countries', 'CountryController@index');
Route::get('/countries/{id}', 'CountryController@show');
Route::post('/countries/create', 'CountryController@store');
Route::put('/countries/update/{id}', 'CountryController@update');

Route::get('/country_games', 'CountryGameController@index');
Route::get('/country_games/{id}', 'CountryGameController@show');
Route::post('/country_games/create', 'CountryGameController@store');
Route::put('/country_games/update/{id}', 'CountryGameController@update');

Route::get('/home_addresses', 'HomeAddressController@index');
Route::get('/home_addresses/{id}', 'HomeAddressController@show');
Route::post('/home_addresses/create', 'HomeAddressController@store');
Route::put('/home_addresses/update/{id}', 'HomeAddressController@update');

Route::get('/regions', 'RegionController@index');
Route::get('/regions/{id}', 'RegionController@show');
Route::post('/regions/create', 'RegionController@store');
Route::put('/regions/update/{id}', 'RegionController@update');

Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@show');
Route::post('/users/create', 'UserController@store');
Route::put('/users/update/{id}', 'UserController@update');

Route::get('/user_followers', 'UserFollowerController@index');
Route::get('/user_followers/{id}', 'UserFollowerController@show');
Route::post('/user_followers/create', 'UserFollowerController@store');
Route::put('/user_followers/update/{id}', 'UserFollowerController@update');

Route::get('/wishlist_games', 'WishListGameController@index');
Route::get('/wishlist_games/{id}', 'WishListGameController@show');
Route::post('/wishlist_games/create', 'WishListGameController@store');
Route::put('/wishlist_games/update/{id}', 'WishListGameController@update');
