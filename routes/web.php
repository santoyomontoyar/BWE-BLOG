<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

// Ruta para ver la pantalla de Login
Route::get('/login', function () {
    return view('auth.login');
}); 

// Ruta para ver el Dashboard principal del Blog
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

// Vista del formulario para crear un nuevo blog
Route::get('/blogs/create', function () {
    return view('admin.create');
});

// Opcional: Redirigir la raíz del sitio directamente al login
Route::get('/', function () {
    return view('auth.login');
});

// Ruta del Dashboard PROTEGIDA con autenticación (middleware(['auth']))
Route::get('/dashboard', function (Request $request) {
    $lang = session('app_locale', 'es');
    $search = $request->get('search');

    $posts = Post::when($search, function ($query, $search) {
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('title_en', 'like', "%{$search}%");
        });
    })
    ->latest()
    ->paginate(10)
    ->withQueryString();

    $posts->getCollection()->transform(function ($post) use ($lang) {
        $post->display_title = ($lang === 'en' && !empty($post->title_en)) ? $post->title_en : $post->title;
        $post->display_excerpt = \Illuminate\Support\Str::limit(
    strip_tags(($lang === 'en' && !empty($post->excerpt_en)) ? $post->excerpt_en : ($post->excerpt ?? $post->content)),
    200
    );
        return $post;
    });

    // Si es una petición AJAX, podemos retornar solo las filas o la tabla parcial si gustas
    if ($request->ajax()) {
        return view('admin.dashboard', compact('posts', 'search'))->render();
    }

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
Route::get('/categories', function () {
    return view('admin.categories');
});

// 1. Mostrar categorías desde MySQL en la vista
Route::get('/categories', function () {
    $categories = Category::all();
    return view('admin.categories', compact('categories'));
});

// 2. Guardar nueva categoría en la base de datos (Método directo sin errores de fillable)
Route::post('/categories', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories,slug',
    ]);

    // Creamos la categoría propiedad por propiedad para evitar bloqueos de caché
    $category = new Category();
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->save();

    return redirect('/categories')->with('success', '¡Categoría creada correctamente!');
});

// 3. Eliminar categoría de la tabla
Route::delete('/categories/{id}', function ($id) {
    Category::findOrFail($id)->delete();
    return redirect('/categories')->with('success', '¡Categoría eliminada con éxito!');
});