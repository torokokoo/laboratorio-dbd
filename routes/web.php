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

Route::get('/comments', 'CommentController@index');
Route::get('/comments/{id}', 'CommentController@show');
Route::post('/comments/create', 'CommentController@store');
Route::put('/comments/update/{id}', 'CommentController@update');
Route::delete('/comments/delete/{id}', 'CommentController@destroy');

Route::get('/currencies', 'CurrencyController@index');
Route::get('/currencies/{id}', 'CurrencyController@show');
Route::post('/currency/create', 'CurrencyController@store');
Route::put('/currency/update/{id}', 'CurrencyController@update');
Route::delete('/currency/delete/{id}', 'CurrencyController@destroy');

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
Route::post('/comuna/create', 'ComunaController@store');
Route::put('/comuna/update/{id}', 'ComunaController@update');

Route::get('/countries', 'CountryController@index');
Route::get('/countries/{id}', 'CountryController@show');
Route::post('/country/create', 'CountryController@store');
Route::put('/country/update/{id}', 'CountryController@update');

Route::get('/country_games', 'CountryGameController@index');
Route::get('/country_games/{id}', 'CountryGameController@show');
Route::post('/country_game/create', 'CountryGameController@store');
Route::put('/country_game/update/{id}', 'CountryGameController@update');

Route::get('/home_addresses', 'HomeAddressController@index');
Route::get('/home_addresses/{id}', 'HomeAddressController@show');
Route::post('/home_address/create', 'HomeAddressController@store');
Route::put('/home_address/update/{id}', 'HomeAddressController@update');

Route::get('/regions', 'RegionController@index');
Route::get('/regions/{id}', 'RegionController@show');
Route::post('/region/create', 'RegionController@store');
Route::put('/region/update/{id}', 'RegionController@update');

Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@show');
Route::post('/user/create', 'UserController@store');
Route::put('/user/update/{id}', 'UserController@update');

Route::get('/user_followers', 'UserFollowerController@index');
Route::get('/user_followers/{id}', 'UserFollowerController@show');
Route::post('/user_follower/create', 'UserFollowerController@store');
Route::put('/user_follower/update/{id}', 'UserFollowerController@update');

Route::get('/wishlist_games', 'WishListGameController@index');
Route::get('/wishlist_games/{id}', 'WishListGameController@show');
Route::post('/wishlist_game/create', 'WishListGameController@store');
Route::put('/wishlist_game/update/{id}', 'WishListGameController@update');

Route::get('/wishlists', 'WishListController@index');
Route::get('/wishlists/{id}', 'WishListController@show');
Route::post('/wishlist/create', 'WishListController@store');
Route::put('/wishlist/update/{id}', 'WishListController@update');

Route::get('/games', 'GameController@index');
Route::get('/games/{id}', 'GameController@show');
Route::post('/game/create', 'GameController@store');
Route::put('/game/update/{id}', 'GameController@update');
Route::delete('/game/delete/{id}', 'GameController@destroy');

Route::get('/game_genders', 'GameGenderController@index');
Route::get('/game_genders/{id}', 'GameGenderController@show');
Route::post('/game_gender/create', 'GameGenderController@store');
Route::put('/game_gender/update/{id}', 'GameGenderController@update');
Route::delete('/game_gender/delete/{id}', 'GameGenderController@destroy');

Route::get('/user_roles_genders', 'UserRoleController@index');
Route::get('/user_roles/{id}', 'UserRoleController@show');
Route::post('/user_role/create', 'UserRoleController@store');
Route::put('/user_role/update/{id}', 'UserRoleController@update');
Route::delete('/user_role/delete/{id}', 'UserRoleController@destroy');

Route::get('/urls', 'UrlController@index');
Route::get('/urls/{id}', 'UrlController@show');
Route::post('/url/create', 'UrlController@store');
Route::put('/url/update/{id}', 'UrlController@update');
Route::delete('/url/delete/{id}', 'UrlController@destroy');

Route::get('/role_permissions', 'RolePermissionController@index');
Route::get('role_permissions/{id}', 'RolePermissionController@show');
Route::post('/role_permission/create', 'RolePermissionController@store');
Route::put('/role_permission/update/{id}', 'RolePermissionController@update');
Route::delete('/role_permission/delete/{id}', 'RolePermissionController@destroy');

Route::get('/roles', 'RoleController@index');
Route::get('roles/{id}', 'RoleController@show');
Route::post('/role/create', 'RoleController@store');
Route::put('/role/update/{id}', 'RoleController@update');
Route::delete('/role/delete/{id}', 'RoleController@destroy');

Route::get('/messages', 'MessageController@index');
Route::get('messages/{id}', 'MessageController@show');
Route::post('/message/create', 'MessageController@store');
Route::put('/message/update/{id}', 'MessageController@update');
Route::delete('/message/delete/{id}', 'MessageController@destroy');

Route::get('/likes', 'LikeController@index');
Route::get('likes/{id}', 'LikeController@show');
Route::post('/like/create', 'LikeController@store');
Route::put('/like/update/{id}', 'LikeController@update');
Route::delete('/like/delete/{id}', 'LikeController@destroy');

Route::get('/libraries', 'LibraryController@index');
Route::get('libraries/{id}', 'LibraryController@show');
Route::post('/library/create', 'LibraryController@store');
Route::put('/library/update/{id}', 'LibraryController@update');
Route::delete('/library/delete/{id}', 'LibraryController@destroy');
