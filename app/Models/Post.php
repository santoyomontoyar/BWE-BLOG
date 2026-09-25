<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

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
            return $this->attributes['excerpt_en'];
        }

        return $this->attributes['excerpt'] ?? $this->attributes['content'];
    }

    // Días restantes antes de eliminación permanente
    public function getDiasParaBorrarAttribute()
    {
        if (!$this->deleted_at) {
            return 30;
        }

        $diasPasados = now()->diffInDays($this->deleted_at);

        return max(0, 30 - $diasPasados);
    }
}