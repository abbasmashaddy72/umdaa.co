<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::get('price', 'APIController@price_plans');
    Route::post('sort_url', 'APIController@sort_url');
    Route::post('edit_sort_url', 'APIController@edit_sort_url');
    Route::post('doctors', 'APIController@doctors');
