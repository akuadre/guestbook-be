<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('users.landing');
})->name('landing');
