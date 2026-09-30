<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::select([
            'id',
            'title',
            'title_en',
            'excerpt',
            'excerpt_en',
            'image_url',
            'slug',
            'slug_en'
        ])->get();

        return response()->json($posts);
    }
    public function show($slug)
    {
            $post = Post::with('categories')
                    ->where('slug', $slug)
                    ->firstOrFail();

            return response()->json([
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,
            'excerpt' => $post->excerpt,
            'image_url' => $post->image_url,
            'slug' => $post->slug,
            'seo_title' => $post->seo_title,
            'seo_description' => $post->seo_description,
            'categories' => $post->categories
        ]);
    }

    public function showEnglish($slug)
    {
        $post = Post::with('categories')
            ->where('slug_en', $slug)
            ->firstOrFail();

        return response()->json([
            'id' => $post->id,
            'title' => $post->title_en,
            'content' => $post->content_en,
            'excerpt' => $post->excerpt_en,
            'image_url' => $post->image_url,
            'slug' => $post->slug_en,
            'seo_title' => $post->seo_title_en,
            'seo_description' => $post->seo_description_en,
            'categories' => $post->categories
        ]);
    }

}
