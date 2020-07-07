<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('order.store', 'HomeController@orderStore');
Route::get('restaurant.details', 'HomeController@restaurantShow');
Route::post('restaurants.search', 'HomeController@search');

/*
|--------------------------------------------------------------------------
| Restaurant Routes
|--------------------------------------------------------------------------
|  Here is where you can operate CRUD operations for restaurant 
*/
Route::group(['middleware' => ['admin']], function () {
	Route::get('restaurant.create', 'RestaurantController@create');
	Route::get('restaurant.edit', 'RestaurantController@edit');
	Route::post('restaurant.store', 'RestaurantController@store');
	Route::post('restaurant.update', 'RestaurantController@update');
	Route::post('restaurant.delete', 'RestaurantController@delete');
	Route::get('restaurants.list', 'RestaurantController@list');
	Route::get('restaurant.show', 'RestaurantController@show');
	/*
	|--------------------------------------------------------------------------
	| Order Routes
	|--------------------------------------------------------------------------
	|  Here is where you can operate CRUD operations for order 
	*/

	Route::get('/dashboard', 'DashboardController@dashboard');
	Route::get('orders.list', 'OrderController@list');
	Route::get('order.details', 'OrderController@orderDetails');
	/*
	|--------------------------------------------------------------------------
	| User Routes
	|--------------------------------------------------------------------------
	|  Here is where you can operate CRUD operations for user 
	*/
	Route::get('users.list', 'UserController@list');
	Route::get('users.create', 'UserController@create');
	Route::post('users.store', 'UserController@store');
	Route::get('users.edit', 'UserController@edit');
	Route::post('users.update', 'UserController@update');
	Route::post('users.delete', 'UserController@delete');

});

