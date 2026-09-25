<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function edit(Post $post)
{
    $categories = Category::all();

    $selectedCategories = $post->categories()
        ->pluck('categories.id')
        ->toArray();

    return view('admin.edit', compact('post', 'categories', 'selectedCategories'));
}

public function update(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'title_en' => 'nullable|string|max:255',
        'content_en' => 'nullable',
        'seo_title' => 'nullable|string|max:255',
        'seo_description' => 'nullable|string',
        'seo_title_en' => 'nullable|string|max:255',
        'seo_description_en' => 'nullable|string',
        'excerpt' => 'nullable|string',
        'excerpt_en' => 'nullable|string',
        'slug' => 'nullable|string|max:255',
        'slug_en' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:5120',
        'categories' => 'nullable|array',
        'categories.*' => 'exists:categories,id',
    ]);

    $post->title = $request->title;
    $post->content = $request->content;
    $post->title_en = $request->title_en;
    $post->content_en = $request->content_en;
    $post->seo_title = $request->seo_title;
    $post->seo_description = $request->seo_description;
    $post->seo_title_en = $request->seo_title_en;
    $post->seo_description_en = $request->seo_description_en;
    $post->excerpt = $request->excerpt;
    $post->excerpt_en = $request->excerpt_en;
    $post->slug = $request->slug;
    $post->slug_en = $request->slug_en;

    // Checkbox "ver portada"
    $post->view_cover = $request->has('view_cover');

    // Si se subió una nueva imagen
    if ($request->hasFile('image')) {

    // Eliminar imagen anterior
    if ($post->image_url && file_exists(public_path($post->image_url))) {
        unlink(public_path($post->image_url));
    }

    $image = $request->file('image');

    // Nombre único de la imagen
    $imageName = time() . '.' . $image->getClientOriginalExtension();

    // Guardar en public/images-post
    $image->move(public_path('images-post'), $imageName);

    // Guardar esta ruta en la BD
    $post->image_url = 'images-post/' . $imageName;
}

    $post->save();

    // Actualizar categorías
    $post->categories()->sync($request->categories ?? []);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Post actualizado exitosamente.');
}


    public function create()
{
    $categories = Category::all();

    return view('admin.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'title_en' => 'nullable|string|max:255',
        'content_en' => 'nullable',
        'seo_title' => 'nullable|string|max:255',
        'seo_description' => 'nullable|string',
        'seo_title_en' => 'nullable|string|max:255',
        'seo_description_en' => 'nullable|string',
        'excerpt' => 'nullable|string',
        'excerpt_en' => 'nullable|string',
        'slug' => 'nullable|string|max:255',
        'slug_en' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:5120',
        'categories' => 'nullable|array',
        'categories.*' => 'exists:categories,id',
    ]);

    $post = new Post();
    $post->user_id = Auth::id();


    $post->title = $request->title;
    $post->content = $request->content;
    $post->title_en = $request->title_en;
    $post->content_en = $request->content_en;
    $post->seo_title = $request->seo_title;
    $post->seo_description = $request->seo_description;
    $post->seo_title_en = $request->seo_title_en;
    $post->seo_description_en = $request->seo_description_en;
    $post->excerpt = $request->excerpt;
    $post->excerpt_en = $request->excerpt_en;
    $post->slug = $request->slug;
    $post->slug_en = $request->slug_en;

    // Checkbox "ver portada"
    $post->view_cover = $request->has('view_cover');

    // Imagen
    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images-post'), $imageName);

        $post->image_url = 'images-post/' . $imageName;
    }

    $post->save();

    // Asignar categorías
    $post->categories()->sync($request->categories ?? []);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Post creado exitosamente.');
}


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()
        ->route('dashboard')
        ->with('success', 'La entrada fue enviada a la papelera correctamente.');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();

        return view('admin.papelera', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()
            ->route('admin.papelera')
            ->with('success', 'Post restaurado exitosamente.');
    }

    public function forceDeleteNow($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        if ($post->image_url && file_exists(public_path($post->image_url))) {
    unlink(public_path($post->image_url));
}

        $post->forceDelete();

        return redirect()
            ->route('admin.papelera')
            ->with('success', 'Post eliminado permanentemente.');
    }
}