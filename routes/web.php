<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'message' => 'Welcome to Inertia.js with React!',
    ]);
});

Route::get('/test', function () {
    return Inertia::render('TestPage');
});
