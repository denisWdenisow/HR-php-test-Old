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

Route::get('/', function () {
    return view('welcome');
});

// Текущая температура в Брянске
Route::get('weather', 'WeatherController@showTemperature');

// Список заказов
Route::get('order','OrderController@orderList');

//Редактирование заказа
Route::get('order_editor','OrderController@showOrder');
Route::post('order_editor','OrderController@saveOrder');