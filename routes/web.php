<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'App\Http\Controllers\ViewCarClasses@viewAll');
Route::get('/models/{id}', 'App\Http\Controllers\ViewCarModels@viewAll');
