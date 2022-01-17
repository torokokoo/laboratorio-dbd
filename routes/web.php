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
// Vista principal de usuario logeado
Route::get('/', function () {
  return view('welcome');
});
// Login - Register
Route::get('/register', 'RegisterController@view'); // Vista Register
Route::post('/register', 'RegisterController@store'); // Registro de usuario
Route::get('/login', 'SessionController@view'); // Vista Login (PENDIENTE)
Route::post('/login', 'SessionController@login');
Route::get('/logout', 'SessionController@logout');

Route::get('/game/create', 'GameController@create');
Route::post('/game/create', 'GameController@store');

// Edicion de datos del usuario
Route::get('user/{user}/editAdmin', 'UserController@editAdmin');  // Vista editar datos de usuario (Admin)
Route::put('user/{user}/edit', 'UserController@update');          // Editar datos de usuario (Usuario)
Route::get('user/{user}/edit', 'UserController@edit');            // Vista editar datos de usuario (Usuario)
Route::put('user/{user}/editAdmin', 'UserController@update');     // Editar datos de usuario (Admin) 

// Edicion de datos del juego
Route::get('game/{game}/edit', 'GameController@edit');            // Vista editar datos de juego (Admin)
Route::put('game/{game}/edit', 'GameController@update');          // Editar datos de juego (Admin)

Route::get('/age_restricions', 'AgeRestrictionController@index');
Route::get('/age_restricion/{id}', 'AgeRestrictionController@show');
Route::post('/age_restricion/create', 'AgeRestrictionController@store');
Route::put('/age_restricion/update/{id}', 'AgeRestrictionController@update');
Route::delete('/age_restricion/delete/{id}', 'AgeRestrictionController@destroy');
Route::delete('/age_restricion/deleteH/{id}', 'AgeRestrictionController@hard_destroy');

Route::get('/comments', 'CommentController@index');
Route::get('/comment/{id}', 'CommentController@show');
Route::post('/comment/create', 'CommentController@store');
Route::put('/comment/update/{id}', 'CommentController@update');
Route::delete('/comment/delete/{id}', 'CommentController@destroy');
Route::delete('/comment/deleteH/{id}', 'CommentController@hard_destroy');

Route::get('/comunas', 'ComunaController@index');
Route::get('/comuna/{id}', 'ComunaController@show');
Route::post('/comuna/create', 'ComunaController@store');
Route::put('/comuna/update/{id}', 'ComunaController@update');
Route::delete('/comuna/delete/{id}', 'ComunaController@destroy');
Route::delete('/comuna/deleteH/{id}', 'ComunaController@hard_destroy');

Route::get('/countries', 'CountryController@index');
Route::get('/country/{id}', 'CountryController@show');
Route::post('/country/create', 'CountryController@store');
Route::put('/country/update/{id}', 'CountryController@update');
Route::delete('/country/delete/{id}', 'CountryController@destroy');
Route::delete('/country/deleteH/{id}', 'CountryController@hard_destroy');

Route::get('/country_games', 'CountryGameController@index');
Route::get('/country_game/{id}', 'CountryGameController@show');
Route::post('/country_game/create', 'CountryGameController@store');
Route::put('/country_game/update/{id}', 'CountryGameController@update');
Route::delete('/country_game/delete/{id}', 'CountryGameController@destroy');
Route::delete('/country_game/deleteH/{id}', 'CountryGameController@hard_destroy');

Route::get('/currencies', 'CurrencyController@index');
Route::get('/currency/{id}', 'CurrencyController@show');
Route::post('/currency/create', 'CurrencyController@store');
Route::put('/currency/update/{id}', 'CurrencyController@update');
Route::delete('/currency/delete/{id}', 'CurrencyController@destroy');
Route::delete('/currency/deleteH/{id}', 'CurrencyController@hard_destroy');

Route::get('/demos', 'DemoController@index');
Route::get('/demo/{id}', 'DemoController@show');
Route::post('/demo/create', 'DemoController@store');
Route::put('/demo/update/{id}', 'DemoController@update');
Route::delete('/demo/delete/{id}', 'DemoController@destroy');
Route::delete('/demo/deleteH/{id}', 'DemoController@hard_destroy');

Route::get('/genders', 'GenderController@index');
Route::get('/gender/{id}', 'GenderController@show');
Route::post('/gender/create', 'GenderController@store');
Route::put('/gender/update/{id}', 'GenderController@update');
Route::delete('/gender/delete/{id}', 'GenderController@destroy');
Route::delete('/gender/deleteH/{id}', 'GenderController@hard_destroy');

Route::get('/', 'GameController@index');
Route::get('/game/{id}', 'GameController@show');
Route::put('/game/update/{id}/edit', 'GameController@update');
Route::delete('/game/delete/{id}', 'GameController@destroy');
Route::delete('/game/deleteH/{id}', 'GameController@hard_destroy');

Route::get('/game_genders', 'GameGenderController@index');
Route::get('/game_gender/{id}', 'GameGenderController@show');
Route::post('/game_gender/create', 'GameGenderController@store');
Route::put('/game_gender/update/{id}', 'GameGenderController@update');
Route::delete('/game_gender/delete/{id}', 'GameGenderController@destroy');
Route::delete('/game_gender/deleteH/{id}', 'GameGenderController@hard_destroy');

Route::get('/home_addresses', 'HomeAddressController@index');
Route::get('/home_address/{id}', 'HomeAddressController@show');
Route::post('/home_address/create', 'HomeAddressController@store');
Route::put('/home_address/update/{id}', 'HomeAddressController@update');
Route::delete('/home_address/delete/{id}', 'HomeAddressController@destroy');
Route::delete('/home_address/deleteH/{id}', 'HomeAddressController@hard_destroy');

Route::get('/libraries', 'LibraryController@index');
Route::get('library/{id}', 'LibraryController@show');
Route::post('/library/create', 'LibraryController@store');
Route::put('/library/update/{id}', 'LibraryController@update');
Route::delete('/library/delete/{id}', 'LibraryController@destroy');
Route::delete('/library/deleteH/{id}', 'LibraryController@hard_destroy');

Route::get('/likes', 'LikeController@index');
Route::get('like/{id}', 'LikeController@show');
Route::post('/like/create', 'LikeController@store');
Route::put('/like/update/{id}', 'LikeController@update');
Route::delete('/like/delete/{id}', 'LikeController@destroy');
Route::delete('/like/deleteH/{id}', 'LikeController@hard_destroy');

Route::get('/messages', 'MessageController@index');
Route::get('message/{id}', 'MessageController@show');
Route::post('/message/create', 'MessageController@store');
Route::put('/message/update/{id}', 'MessageController@update');
Route::delete('/message/delete/{id}', 'MessageController@destroy');
Route::delete('/message/deleteH/{id}', 'MessageController@hard_destroy');

Route::get('/permissions', 'PermissionController@index');
Route::get('permission/{id}', 'PermissionController@show');
Route::post('/permission/create', 'PermissionController@store');
Route::put('/permission/update/{id}', 'PermissionController@update');
Route::delete('/permission/delete/{id}', 'PermissionController@destroy');
Route::delete('/permission/deleteH/{id}', 'PermissionController@hard_destroy');

Route::get('/regions', 'RegionController@index');
Route::get('/region/{id}', 'RegionController@show');
Route::post('/region/create', 'RegionController@store');
Route::put('/region/update/{id}', 'RegionController@update');
Route::delete('/region/delete/{id}', 'RegionController@destroy');
Route::delete('/region/deleteH/{id}', 'RegionController@hard_destroy');

Route::get('/role_permissions', 'RolePermissionController@index');
Route::get('role_permission/{id}', 'RolePermissionController@show');
Route::post('/role_permission/create', 'RolePermissionController@store');
Route::put('/role_permission/update/{id}', 'RolePermissionController@update');
Route::delete('/role_permission/delete/{id}', 'RolePermissionController@destroy');
Route::delete('/role_permission/deleteH/{id}', 'RolePermissionController@hard_destroy');

Route::get('/roles', 'RoleController@index');
Route::get('role/{id}', 'RoleController@show');
Route::post('/role/create', 'RoleController@store');
Route::put('/role/update/{id}', 'RoleController@update');
Route::delete('/role/delete/{id}', 'RoleController@destroy');
Route::delete('/role/deleteH/{id}', 'RoleController@hard_destroy');

Route::get('/transactions', 'TransactionController@index');
Route::get('/transaction/{id}', 'TransactionController@show');
Route::post('/transaction/create', 'TransactionController@store');
Route::put('/transaction/update/{id}', 'TransactionController@update');
Route::delete('/transaction/delete/{id}', 'TransactionController@destroy');
Route::delete('/transaction/deleteH/{id}', 'TransactionController@hard_destroy');

Route::get('/urls', 'UrlController@index');
Route::get('/url/{id}', 'UrlController@show');
Route::post('/url/create', 'UrlController@store');
Route::put('/url/update/{id}', 'UrlController@update');
Route::delete('/url/delete/{id}', 'UrlController@destroy');
Route::delete('/url/deleteH/{id}', 'UrlController@hard_destroy');

Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');
Route::post('/user/create', 'UserController@store');
Route::put('/user/update/{id}', 'UserController@update');
Route::delete('/user/delete/{id}', 'UserController@destroy');
Route::delete('/user/deleteH/{id}', 'UserController@hard_destroy');

Route::get('/user_roles_genders', 'UserRoleController@index');
Route::get('/user_role/{id}', 'UserRoleController@show');
Route::post('/user_role/create', 'UserRoleController@store');
Route::put('/user_role/update/{id}', 'UserRoleController@update');
Route::delete('/user_role/delete/{id}', 'UserRoleController@destroy');
Route::delete('/user_role/deleteH/{id}', 'UserRoleController@hard_destroy');

Route::get('/user_followers', 'UserFollowerController@index');
Route::get('/user_follower/{id}', 'UserFollowerController@show');
Route::post('/user_follower/create', 'UserFollowerController@store');
Route::put('/user_follower/update/{id}', 'UserFollowerController@update');
Route::delete('/user_follower/delete/{id}', 'UserFollowerController@destroy');
Route::delete('/user_follower/deleteH/{id}', 'UserFollowerController@hard_destroy');

Route::get('/wishlist_games', 'WishListGameController@index');
Route::get('/wishlist_game/{id}', 'WishListGameController@show');
Route::post('/wishlist_game/create', 'WishListGameController@store');
Route::put('/wishlist_game/update/{id}', 'WishListGameController@update');
Route::delete('/wishlist_game/delete/{id}', 'WishListGameController@destroy');
Route::delete('/wishlist_game/deleteH/{id}', 'WishListGameController@hard_destroy');

Route::get('/wishlists', 'WishListController@index');
Route::get('/wishlist/{id}', 'WishListController@show');
Route::post('/wishlist/create', 'WishListController@store');
Route::put('/wishlist/update/{id}', 'WishListController@update');
Route::delete('/wishlist/delete/{id}', 'WishListController@destroy');
Route::delete('/wishlist/deleteH/{id}', 'WishListController@hard_destroy');
