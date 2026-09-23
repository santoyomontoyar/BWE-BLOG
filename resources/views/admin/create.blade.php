@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto pb-12">
    <!-- Encabezado superior -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">EDITANDO POST</h2>
            <!-- Pestañas de Idioma estilo Blogger -->
            <div class="inline-flex bg-gray-200 p-1 rounded-xl">
                <button type="button" class="bg-black text-white px-4 py-1.5 rounded-lg text-xs font-semibold shadow">🇪🇸 Español</button>
                <button type="button" class="text-gray-700 hover:text-black px-4 py-1.5 rounded-lg text-xs font-semibold transition">🇬🇧 English</button>
            </div>
        </div>
        <a href="/dashboard" class="text-sm font-bold text-gray-800 hover:underline uppercase tracking-wider">
            REGRESAR &rarr;
        </a>
    </div>

    <!-- Layout de Dos Columnas (Estilo Blogger / CMS) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- COLUMNA IZQUIERDA (Contenido Principal - Ocupa 2 espacios) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Título -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Título</label>
                <input type="text" placeholder="Escribe el título de tu entrada..." 
                       class="w-full text-lg font-semibold border-b border-gray-200 pb-2 focus:outline-none focus:border-blue-600 transition bg-transparent">
            </div>

            <!-- Editor de Texto (Simulado profesional) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-3">
                    <label class="text-xs font-bold text-gray-500 uppercase">Contenido</label>
                    <span class="text-xs text-blue-600 font-medium">tiny editor</span>
                </div>
                <!-- Barra de herramientas simulada -->
                <div class="flex flex-wrap items-center gap-2 border border-gray-200 rounded-t-xl bg-gray-50 p-2 text-xs text-gray-600">
                    <button type="button" class="px-2 py-1 hover:bg-gray-200 rounded font-bold">File</button>
                    <button type="button" class="px-2 py-1 hover:bg-gray-200 rounded">Edit</button>
                    <button type="button" class="px-2 py-1 hover:bg-gray-200 rounded">View</button>
                    <button type="button" class="px-2 py-1 hover:bg-gray-200 rounded">Insert</button>
                    <button type="button" class="px-2 py-1 hover:bg-gray-200 rounded">Format</button>
                    <button type="button" class="px-2 py-1 hover:bg-gray-200 rounded">Table</button>
                    <div class="h-4 w-px bg-gray-300 mx-1"></div>
                    <button type="button" class="px-2 py-1 hover:bg-gray-200 rounded font-bold">B</button>
                    <button type="button" class="px-2 py-1 hover:bg-gray-200 rounded italic">I</button>
                </div>
                <textarea rows="8" placeholder="Empieza a redactar el contenido de tu entrada aquí..."
                          class="w-full border border-t-0 border-gray-200 rounded-b-xl p-4 text-sm focus:outline-none focus:ring-1 focus:ring-blue-600 transition resize-none"></textarea>
            </div>

            <!-- Sección SEO -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide border-b pb-2">SEO — Español</h3>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Título SEO</label>
                    <input type="text" placeholder="Título optimizado para buscadores..." 
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Descripción SEO</label>
                    <textarea rows="2" placeholder="Breve descripción para Google..."
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none"></textarea>
                </div>
            </div>

        </div>

        <!-- COLUMNA DERECHA (Widgets Laterales - Ocupa 1 espacio) -->
        <div class="space-y-6">
            
            <!-- Imagen Destacada -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-3">Imagen destacada</label>
                <div class="flex items-center gap-3 mb-3">
                    <button type="button" class="bg-purple-100 text-purple-700 px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-purple-200 transition">Seleccionar archivo</button>
                    <span class="text-xs text-gray-400">Sin archivo...leccionados</span>
                </div>
                <div class="bg-gray-50 border border-dashed border-gray-200 rounded-xl h-32 flex items-center justify-center text-gray-400 text-xs">
                    Vista previa de imagen
                </div>
            </div>

            <!-- Extractos -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Extracto — Español</label>
                    <textarea rows="3" placeholder="Resumen corto..." class="w-full border border-gray-200 rounded-xl p-3 text-xs focus:outline-none resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Excerpt — English</label>
                    <textarea rows="3" placeholder="Short summary..." class="w-full border border-gray-200 rounded-xl p-3 text-xs focus:outline-none resize-none"></textarea>
                </div>
                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" id="hide_cover" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="hide_cover" class="text-xs font-medium text-gray-700">¿Deseas ocultar la portada?</label>
                </div>
            </div>

            <!-- Categorías con Checkboxes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-3">Categories</label>
                <div class="space-y-2 max-h-48 overflow-y-auto pr-2 text-sm text-gray-700">
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Marketing</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Industria restaurantera</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Fotografía</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Video</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Publicidad</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Diseño digital</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Experiencia</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Social Media</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Desarrollo Web</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Branding</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer" checked><input type="checkbox" class="rounded text-blue-600" checked> Inteligencia Artificial</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Marcas</label>
                    <label class="flex items-center gap-2.5 hover:bg-gray-50 p-1 rounded cursor-pointer"><input type="checkbox" class="rounded text-blue-600"> Trends</label>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection