@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto pb-12">

    {{-- =========================================================
         ENCABEZADO
    ========================================================== --}}
    <div class="flex justify-between items-center mb-8">

        <div class="flex items-center gap-4">

            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                EDITANDO POST
            </h2>

            {{-- Selector de idioma --}}
            @php $currentLang = session('app_locale', 'es'); @endphp

<div class="text-sm text-gray-600 flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-full border border-gray-100">
    <span>Idioma:</span>

    <button
    type="button"
    id="btn-es"
    class="language-btn font-semibold px-3 py-0.5 rounded-full text-xs transition
    {{ $currentLang == 'es' ? 'text-blue-700 bg-blue-100' : 'text-gray-500 hover:text-gray-800' }}">
    ES Español
</button>

<button
    type="button"
    id="btn-en"
    class="language-btn font-semibold px-3 py-0.5 rounded-full text-xs transition
    {{ $currentLang == 'en' ? 'text-blue-700 bg-blue-100' : 'text-gray-500 hover:text-gray-800' }}">
    EN English
</button>
</div>

        </div>

        <a
            href="{{ route('dashboard') }}"
            class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-50 transition shadow-sm">

            &larr; Volver al Dashboard

        </a>

    </div>


    {{-- =========================================================
         ERRORES
    ========================================================== --}}
    @if ($errors->any())

        <div class="bg-red-50 border border-red-200 text-red-700 rounded-2xl p-5 mb-6">

            <p class="font-bold text-sm mb-2">
                No se pudieron guardar los cambios:
            </p>

            <ul class="list-disc pl-5 text-sm space-y-1">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
         FORMULARIO
    ========================================================== --}}
    <form
        id="editPostForm"
        action="{{ route('posts.update', $post->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')


        {{-- =====================================================
             CONTENIDO PRINCIPAL
        ====================================================== --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">


            {{-- =================================================
                 COLUMNA IZQUIERDA
            ================================================== --}}
            <div class="lg:col-span-2">


                {{-- =================================================
                     ESPAÑOL
                ================================================== --}}
                <div id="language-es" class="language-panel space-y-6">


                    {{-- TÍTULO --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                            Título
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $post->title) }}"
                            placeholder="Escribe el título de tu entrada..."
                            class="w-full text-lg font-semibold border-b border-gray-200 pb-2 focus:outline-none focus:border-blue-600 transition bg-transparent"
                            required>

                    </div>


                    {{-- CONTENIDO --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                        <div class="flex justify-between items-center mb-3">

                            <label class="text-xs font-bold text-gray-500 uppercase">
                                Contenido
                            </label>

                            <span class="text-xs text-blue-600 font-medium">
                                Content editor
                            </span>

                        </div>

                        <textarea
                            id="content"
                            name="content"
                            rows="16"
                            class="tinymce-editor w-full"
                            placeholder="Empieza a redactar el contenido de tu entrada aquí...">{{ old('content', $post->content) }}</textarea>

                    </div>


                    {{-- SEO --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 space-y-5">

                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide border-b pb-2">
                            SEO — Español
                        </h3>

                        <div>

                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">
                                Título SEO
                            </label>

                            <input
                                type="text"
                                name="seo_title"
                                value="{{ old('seo_title', $post->seo_title) }}"
                                placeholder="Título optimizado para buscadores..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">

                        </div>

                        <div>

                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">
                                Descripción SEO
                            </label>

                            <textarea
                                name="seo_description"
                                rows="3"
                                placeholder="Breve descripción para Google..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none">{{ old('seo_description', $post->seo_description) }}</textarea>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ENGLISH
                ================================================== --}}
                <div
                    id="language-en"
                    class="language-panel space-y-6 hidden">


                    {{-- TITLE --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                            Title — English
                        </label>

                        <input
                            type="text"
                            name="title_en"
                            value="{{ old('title_en', $post->title_en) }}"
                            placeholder="Write the title..."
                            class="w-full text-lg font-semibold border-b border-gray-200 pb-2 focus:outline-none focus:border-blue-600 transition bg-transparent">

                    </div>


                    {{-- CONTENT --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                        <div class="flex justify-between items-center mb-3">

                            <label class="text-xs font-bold text-gray-500 uppercase">
                                Content — English
                            </label>

                            <span class="text-xs text-blue-600 font-medium">
                                Content editor
                            </span>

                        </div>

                        <textarea
                            id="content_en"
                            name="content_en"
                            rows="16"
                            class="tinymce-editor w-full"
                            placeholder="Write the content here...">{{ old('content_en', $post->content_en) }}</textarea>

                    </div>


                    {{-- SEO ENGLISH --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 space-y-5">

                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide border-b pb-2">
                            SEO — English
                        </h3>

                        <div>

                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">
                                SEO Title
                            </label>

                            <input
                                type="text"
                                name="seo_title_en"
                                value="{{ old('seo_title_en', $post->seo_title_en) }}"
                                placeholder="SEO title..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">

                        </div>

                        <div>

                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">
                                SEO Description
                            </label>

                            <textarea
                                name="seo_description_en"
                                rows="3"
                                placeholder="SEO description..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none">{{ old('seo_description_en', $post->seo_description_en) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 COLUMNA DERECHA
            ================================================== --}}
            <div class="space-y-6">


                {{-- =================================================
                     IMAGEN DESTACADA
                ================================================== --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                    <label class="block text-xs font-bold text-gray-500 uppercase mb-3">
                        Imagen destacada
                    </label>

                    @if ($post->image_url)

                        <div class="mb-4">

                            <p class="text-xs text-gray-500 mb-2">
                                Imagen actual
                            </p>

                            <img
                                src="{{ asset($post->image_url) }}"
                                alt="{{ $post->title }}"
                                class="w-full h-44 object-cover rounded-xl border border-gray-200 shadow-sm">

                        </div>

                    @else

                        <div class="bg-gray-50 border border-dashed border-gray-200 rounded-xl h-32 flex items-center justify-center text-gray-400 text-xs mb-4">
                            Este post no tiene imagen
                        </div>

                    @endif


                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                        class="block w-full text-xs text-gray-500
                               file:mr-3
                               file:py-2
                               file:px-3
                               file:rounded-lg
                               file:border-0
                               file:text-xs
                               file:font-semibold
                               file:bg-purple-100
                               file:text-purple-700
                               hover:file:bg-purple-200">

                    <p class="text-xs text-gray-400 mt-2">
                        Déjalo vacío para conservar la imagen actual.
                    </p>

                </div>


                {{-- =================================================
                     EXTRACTO
                ================================================== --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                    {{-- ESPAÑOL --}}
                    <div id="excerpt-es">

                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                            Extracto — Español
                        </label>

                        <textarea
                            name="excerpt"
                            rows="4"
                            placeholder="Resumen corto..."
                            class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none">{{ old('excerpt', $post->excerpt) }}</textarea>

                    </div>


                    {{-- ENGLISH --}}
                    <div id="excerpt-en" class="hidden">

                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">
                            Excerpt — English
                        </label>

                        <textarea
                            name="excerpt_en"
                            rows="4"
                            placeholder="Short summary..."
                            class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none">{{ old('excerpt_en', $post->excerpt_en) }}</textarea>

                    </div>


                    {{-- PORTADA --}}
                    <div class="flex items-center gap-2 pt-5 mt-5 border-t border-gray-100">

                        <input
                            type="checkbox"
                            name="view_cover"
                            value="1"
                            id="view_cover"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            {{ old('view_cover', $post->view_cover) ? 'checked' : '' }}>

                        <label
                            for="view_cover"
                            class="text-xs font-medium text-gray-700">
                            ¿Mostrar la portada?
                        </label>

                    </div>

                </div>


                {{-- =================================================
                     CATEGORÍAS
                ================================================== --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                    <label class="block text-xs font-bold text-gray-500 uppercase mb-3">
                        Categories
                    </label>

                    <div class="space-y-2 max-h-52 overflow-y-auto pr-2 text-sm text-gray-700">

                        @forelse ($categories as $category)

                            <label class="flex items-center gap-2.5 hover:bg-gray-50 p-2 rounded-lg cursor-pointer">

                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    class="rounded text-blue-600"
                                    {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>

                                <span>
                                    {{ $category->name }}
                                </span>

                            </label>

                        @empty

                            <p class="text-xs text-gray-400">
                                No hay categorías disponibles.
                            </p>

                        @endforelse

                    </div>

                </div>


                {{-- =================================================
                     SLUG ESPAÑOL
                ================================================== --}}
                <div id="slug-es"
                     class="slug-panel bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">
                        Slug
                    </label>

                    <input
                        type="text"
                        name="slug"
                        value="{{ old('slug', $post->slug) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">

                </div>


                {{-- =================================================
                     SLUG ENGLISH
                ================================================== --}}
                <div id="slug-en"
                     class="slug-panel bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hidden">

                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">
                        Slug — English
                    </label>

                    <input
                        type="text"
                        name="slug_en"
                        value="{{ old('slug_en', $post->slug_en) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">

                </div>

            </div>

        </div>


        {{-- =========================================================
             BOTONES
             FOOTER INDEPENDIENTE Y ALINEADO
        ========================================================== --}}
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end items-center gap-3">

            <a
                href="{{ route('dashboard') }}"
                class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">

                Cancelar

            </a>

            <button
                type="submit"
                class="px-5 py-2.5 rounded-xl bg-black text-white text-sm font-semibold hover:bg-gray-800 transition">

                Guardar cambios

            </button>

        </div>

    </form>

</div>


{{-- =============================================================
     TINYMCE
============================================================= --}}
<script
    src="https://cdn.tiny.cloud/1/swq9tj1m3a4lggq4y82tjtjyyl3umu1i3phz6cmjfylsawud/tinymce/8/tinymce.min.js"
    referrerpolicy="origin"
    crossorigin="anonymous">
</script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | TINYMCE
    |--------------------------------------------------------------------------
    */

    tinymce.init({

        selector: '#content, #content_en',

        height: 500,

        menubar: 'file edit view insert format table tools help',

        plugins: [
            'advlist',
            'autolink',
            'lists',
            'link',
            'image',
            'charmap',
            'preview',
            'anchor',
            'searchreplace',
            'visualblocks',
            'code',
            'fullscreen',
            'insertdatetime',
            'media',
            'table',
            'wordcount',
            'help'
        ],

        toolbar:
            'undo redo | ' +
            'blocks | ' +
            'bold italic underline | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist | ' +
            'outdent indent | ' +
            'link image media | ' +
            'removeformat | ' +
            'code fullscreen',

        toolbar_mode: 'sliding',

        branding: false,

        promotion: false,

        statusbar: true,

        resize: true,

        elementpath: true,

        content_style:
            'body {' +
            'font-family: Arial, sans-serif;' +
            'font-size: 14px;' +
            'line-height: 1.6;' +
            'padding: 10px;' +
            '}' +

            'p {' +
            'margin: 0 0 12px 0;' +
            '}' +

            'h1, h2, h3, h4 {' +
            'margin-top: 20px;' +
            'margin-bottom: 10px;' +
            '}' +

            'ul, ol {' +
            'padding-left: 25px;' +
            '}',

        setup: function (editor) {

            editor.on('change keyup undo redo', function () {
                editor.save();
            });

        }

    });


    /*
    |--------------------------------------------------------------------------
    | ELEMENTOS DE IDIOMA
    |--------------------------------------------------------------------------
    */

    const btnEs = document.getElementById('btn-es');
    const btnEn = document.getElementById('btn-en');

    const panelEs = document.getElementById('language-es');
    const panelEn = document.getElementById('language-en');

    const excerptEs = document.getElementById('excerpt-es');
    const excerptEn = document.getElementById('excerpt-en');

    const slugEs = document.getElementById('slug-es');
    const slugEn = document.getElementById('slug-en');


    /*
    |--------------------------------------------------------------------------
    | ACTIVAR ESPAÑOL
    |--------------------------------------------------------------------------
    */

    function activateSpanish() {

        panelEs.classList.remove('hidden');
        panelEn.classList.add('hidden');

        excerptEs.classList.remove('hidden');
        excerptEn.classList.add('hidden');

        slugEs.classList.remove('hidden');
        slugEn.classList.add('hidden');

        btnEs.className = 'language-btn font-semibold text-blue-700 bg-blue-100 px-3 py-0.5 rounded-full text-xs transition';
        btnEn.className = 'language-btn font-semibold text-gray-500 hover:text-gray-800 px-3 py-0.5 rounded-full text-xs transition';


    }


    /*
    |--------------------------------------------------------------------------
    | ACTIVAR INGLÉS
    |--------------------------------------------------------------------------
    */

    function activateEnglish() {

        panelEs.classList.add('hidden');
        panelEn.classList.remove('hidden');

        excerptEs.classList.add('hidden');
        excerptEn.classList.remove('hidden');

        slugEs.classList.add('hidden');
        slugEn.classList.remove('hidden');

        btnEs.className = 'language-btn font-semibold text-gray-500 hover:text-gray-800 px-3 py-0.5 rounded-full text-xs transition';
        btnEn.className = 'language-btn font-semibold text-blue-700 bg-blue-100 px-3 py-0.5 rounded-full text-xs transition';

    }


    btnEs.addEventListener('click', activateSpanish);

    btnEn.addEventListener('click', activateEnglish);


    /*
    |--------------------------------------------------------------------------
    | GUARDAR
    |--------------------------------------------------------------------------
    */

    const form = document.getElementById('editPostForm');

    form.addEventListener('submit', function () {

        if (typeof tinymce !== 'undefined') {

            tinymce.triggerSave();

        }

    });

});

</script>

@endsection