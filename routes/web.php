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

Route::post('/ordered_pizzas', 'OrderedPizzaController@store')->name('ordered_pizza.store');
Route::delete('/ordered_pizzas/{ordered_pizza:id}', 'OrderedPizzaController@destroy')->name('ordered_pizza.destroy');

Route::patch('/orders/{order:id}', 'OrderController@update')->name('order.update');
Route::get('/order/{order:id}', 'OrderController@finish')->name('order.finish');
