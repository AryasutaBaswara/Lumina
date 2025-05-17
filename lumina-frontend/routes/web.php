<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // resources/views/auth.blade.php
});

Route::get('/auth', function () {
    return view('auth'); // resources/views/auth.blade.php
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/history', function () {
    return view('history');
});

Route::get('/profile', function () {
    return view('profile');
});

