<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/posts', [PostController::class, 'index']); // Ruta para obtener todos los posts

Route::get('/posts/es/{slug}', [PostController::class, 'show']); // Ruta para obtener un post específico en español por slug

Route::get('/posts/en/{slug}', [PostController::class, 'showEnglish']); // Ruta para obtener un post específico en inglés por slug

Route::get('/categories', [CategoryController::class, 'index']); // Ruta para obtener todas las categorías