<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/form', function () {
    return view('form');
});

Route::get('/users', [FormController::class, 'users']);
Route::post('/submit', [FormController::class, 'submitForm']);