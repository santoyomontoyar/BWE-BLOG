<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Http\Request;

// Ruta raíz redirige al login
Route::get('/', function () {
    return view('auth.login');
});

// Ruta del Dashboard PROTEGIDA con autenticación (middleware(['auth']))
Route::get('/dashboard', function (Request $request) {
    $lang = session('app_locale', 'es');
    $search = $request->get('search');

    $query = Post::query();

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('title_en', "%{$search}%");
        });
    }

    $posts = $query->paginate(20)->withQueryString();

    $posts->getCollection()->transform(function ($post) use ($lang) {
        $post->display_title = ($lang === 'en' && !empty($post->title_en)) ? $post->title_en : $post->title;
        $post->display_excerpt = ($lang === 'en' && !empty($post->excerpt_en)) ? $post->excerpt_en : ($post->excerpt ?? $post->content);
        return $post;
    });

    return view('admin.dashboard', compact('posts', 'search'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta para el cambio de idioma
Route::get('/language/{lang}', function ($lang) {
    if (in_array($lang, ['es', 'en'])) {
        session(['app_locale' => $lang]);
    }
    return redirect()->back();
})->name('language.switch');

// Cargar las rutas automáticas de autenticación que genera Laravel
require __DIR__.'/auth.php';