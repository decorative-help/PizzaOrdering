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

Route::get('/', 'PizzaController@index')->name('home');
Route::post('/ordered_pizzas', 'PizzaController@store');

Route::patch('/orders/{order:id}', 'OrderController@update')->name('order.update');
Route::get('/order/{order:id}', 'OrderController@finish')->name('order.finish');
