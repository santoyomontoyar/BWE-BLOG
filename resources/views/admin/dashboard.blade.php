@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Blog</h2>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
    <!-- Cabecera de la tabla (Filtros y Título) -->
    <div class="flex justify-between items-center mb-8 pb-6 border-b border-gray-100">
        <h3 class="font-bold text-xl text-gray-800 flex items-center gap-3">
            Lista de Entradas
        </h3>
        
        <div class="flex items-center space-x-6">
            <!-- Selector de Idioma -->
                @php $currentLang = session('app_locale', 'es'); @endphp
            <div class="text-sm text-gray-600 flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-full border border-gray-100">
                <span>Idioma:</span>
                <a href="{{ route('language.switch', 'es') }}" class="font-semibold {{ $currentLang == 'es' ? 'text-blue-700 bg-blue-100 px-3 py-0.5 rounded-full text-xs' : 'text-gray-500 hover:text-gray-800 px-3 py-0.5 rounded-full text-xs transition' }}">ES Español</a>
                <a href="{{ route('language.switch', 'en') }}" class="font-semibold {{ $currentLang == 'en' ? 'text-blue-700 bg-blue-100 px-3 py-0.5 rounded-full text-xs' : 'text-gray-500 hover:text-gray-800 px-3 py-0.5 rounded-full text-xs transition' }}">EN English</a>
            </div>
            
            <!-- Barra de Búsqueda Mejorada -->
            <div class="relative">
    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    </span>
    <input type="text" 
        id="searchInput"
        value="{{ request('search') }}"
        placeholder="Buscar por título..." 
        class="border border-gray-200 bg-gray-50 rounded-full pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition w-64">
</div>
        </div>
    </div>

    <!-- TABLA DE ENTRADAS -->
     <div id="results-container">
    <table id="posts-table" class="w-full text-left border-collapse table-fixed">
        <thead>
            <tr class="text-gray-500 text-xs uppercase tracking-wider">
                <th class="py-5 px-5 font-medium w-16">No.</th>
                <th class="py-5 px-5 font-medium w-24">Imagen</th>
                <th class="py-5 px-5 font-medium w-1/3">Título</th>
                <th class="py-5 px-5 font-medium w-4/12">Resumen</th>
                <th class="py-5 px-5 font-medium text-center w-48">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-sm divide-y divide-gray-50">
            @forelse($posts as $index => $post)
                <tr class="post-row hover:bg-blue-50/50 transition-colors group">
                    <!-- Columna Número -->
                    <td class="py-6 px-5 font-semibold text-gray-800 align-top row-number">
                        {{ $posts->firstItem() + $index }}
                    </td>
                    
                    <!-- Columna Previsualización de Imagen -->
                    <td class="py-6 px-5 align-top">
                        @if($post->image_url)
                            <img src="{{ asset($post->image_url) }}" alt="Miniatura" class="w-16 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                        @else
                            <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs font-medium">Sin img</div>
                        @endif
                    </td>

                    <!-- Columna Título -->
                    <td class="py-6 px-5 align-top overflow-hidden">
                        <p class="font-bold text-gray-900 leading-snug group-hover:text-blue-800 line-clamp-2 post-title-text">
                            {{ $post->display_title }}
                        </p>
                    </td>

                    <!-- Columna Resumen -->
                    <td class="py-6 px-5 text-gray-600 leading-relaxed align-top overflow-hidden">
                        <p class="line-clamp-2 break-words">
                            {{ $post->display_excerpt }}
                        </p>
                    </td>
                    
                    <!-- Columna Acciones -->
                    <td class="py-6 px-5 text-center align-top">
                        <div class="flex justify-center items-center gap-4 text-sm font-medium">
                            <a href="#" class="text-emerald-600 hover:text-emerald-900 hover:underline">Editar</a>
                            <button class="text-red-600 hover:text-red-900 hover:underline">Eliminar</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-gray-500 font-medium">
                        Sin coincidencias
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div id="paginationContainer" class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100 text-sm text-gray-600">
        <p>
            Mostrando 
            <span id="showing-start" class="font-semibold text-gray-800">{{ $posts->firstItem() ?? 0 }}</span> a 
            <span id="showing-end" class="font-semibold text-gray-800">{{ $posts->lastItem() ?? 0 }}</span> de 
            <span id="showing-total" class="font-semibold text-gray-800">{{ $posts->total() }}</span> entradas
        </p>
        <div class="flex gap-1">
            <!-- Botón Anterior -->
            @if ($posts->onFirstPage())
                <button class="px-3 py-1 border border-gray-200 rounded-lg text-gray-300 bg-gray-50 cursor-not-allowed" disabled>&laquo; Anterior</button>
            @else
                <a href="{{ $posts->previousPageUrl() }}" class="px-3 py-1 border border-gray-200 rounded-lg hover:bg-gray-50 text-gray-700 transition">Anterior</a>
            @endif

            <!-- Lógica para mostrar un máximo de 5 páginas -->
            @php
                $currentPage = $posts->currentPage();
                $lastPage = $posts->lastPage();
                
                // Calcular el inicio y el fin del rango (máximo 5 elementos)
                $start = max($currentPage - 2, 1);
                $end = min($start + 4, $lastPage);
                
                if ($end - $start < 4) {
                    $start = max($end - 4, 1);
                }
            @endphp

            <!-- Números de página -->
            @foreach ($posts->getUrlRange($start, $end) as $page => $url)
                @if ($page == $currentPage)
                    <span class="px-3 py-1 border border-blue-200 bg-blue-50 text-blue-700 rounded-lg font-semibold">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1 border border-gray-200 rounded-lg hover:bg-gray-50 text-gray-700 transition">{{ $page }}</a>
                @endif
            @endforeach

            <!-- Botón Siguiente -->
            @if ($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" class="px-3 py-1 border border-gray-200 rounded-lg hover:bg-gray-50 text-gray-700 transition">Siguiente &raquo;</a>
            @else
                <button class="px-3 py-1 border border-gray-200 rounded-lg text-gray-300 bg-gray-50 cursor-not-allowed" disabled>Siguiente &raquo;</button>
            @endif
        </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        let timeout = null;

        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            let query = this.value;

            // 250ms para no saturar al escribir rápido
            timeout = setTimeout(() => {
                fetch(`{{ route('dashboard') }}?search=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Convierte el HTML recibido en un documento temporal
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    
                    // Extrae solo el contenedor de resultados actualizado
                    let newResults = doc.getElementById('results-container');
                    
                    if (newResults) {
                        // Reemplazamos la tabla y paginación en pantalla
                        document.getElementById('results-container').innerHTML = newResults.innerHTML;
                        
                        // Restaura el foco y la posición del cursor en el input
                        const inputField = document.getElementById('searchInput');
                        inputField.focus();
                        inputField.setSelectionRange(inputField.value.length, inputField.value.length);
                    }
                })
                .catch(error => console.error('Error en la búsqueda:', error));
            }, 250);
        });
    });
</script>