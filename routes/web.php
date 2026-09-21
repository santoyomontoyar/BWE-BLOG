<?php

use Illuminate\Support\Facades\Route;

// Ruta para ver la pantalla de Login
Route::get('/login', function () {
    return view('auth.login');
});

// Ruta para ver el Dashboard principal del Blog
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

// Opcional: Redirigir la raíz del sitio directamente al login
Route::get('/', function () {
    return view('auth.login');
});

