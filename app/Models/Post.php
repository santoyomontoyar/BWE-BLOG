<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    // Accessor inteligente para el Título
    public function getTitleAttribute()
    {
        $lang = session('app_locale', 'es');
        
        if ($lang === 'en' && !empty($this->attributes['title_en'])) {
            return $this->attributes['title_en'];
        }
        
        return $this->attributes['title'];
    }

    // Accessor inteligente para el Resumen
    public function getExcerptAttribute()
    {
        $lang = session('app_locale', 'es');
        
        if ($lang === 'en' && !empty($this->attributes['excerpt_en'])) {
            return $this->attributes['excerpt_en']; // Muestra el resumen en inglés si existe
        }
        
        // Si está en español, toma la columna 'excerpt' o el 'content' como respaldo
        return $this->attributes['excerpt'] ?? $this->attributes['content'];
    }
}