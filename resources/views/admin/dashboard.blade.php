@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Blog</h2>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
    <!-- Cabecera de la tabla (Filtros y Título) -->
    <div class="flex justify-between items-center mb-8 pb-6 border-b border-gray-100">
        <h3 class="font-bold text-xl text-gray-800 flex items-center gap-3">
            <span class="text-2xl">📋</span> Lista de Entradas
        </h3>
        
        <div class="flex items-center space-x-6">
            <!-- Selector de Idioma Mejorado -->
            <div class="text-sm text-gray-600 flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-full border border-gray-100">
                <span>Idioma:</span>
                <button class="font-semibold text-blue-700 bg-blue-100 px-3 py-0.5 rounded-full text-xs">ES Español</button>
                <button class="font-medium text-gray-500 hover:text-gray-800 px-3 py-0.5 rounded-full text-xs transition">GB English</button>
            </div>
            
            <!-- Barra de Búsqueda Mejorada -->
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Buscar por título..." 
                       class="border border-gray-200 bg-gray-50 rounded-full pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition w-64">
            </div>
        </div>
    </div>

    <!-- TABLA DE ENTRADAS (Rediseñada) -->
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="text-gray-500 text-xs uppercase tracking-wider">
                <th class="py-5 px-5 font-medium w-16">No.</th>
                <th class="py-5 px-5 font-medium">Título</th>
                <th class="py-5 px-5 font-medium w-1/3">Resumen</th>
                <th class="py-5 px-5 font-medium text-center w-48">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-sm divide-y divide-gray-50">
            
            <!-- Fila 1 -->
            <tr class="hover:bg-blue-50/50 transition-colors group">
                <td class="py-6 px-5 font-semibold text-gray-800">1</td>
                <td class="py-6 px-5">
                    <p class="font-bold text-gray-900 leading-snug group-hover:text-blue-800">
                        Checklist GEO: Cómo lograr que la Inteligencia Artificial recomiende tu marca en 2026
                    </p>
                    <span class="inline-flex items-center gap-1 mt-1.5 text-xs font-medium text-green-700 bg-green-50 px-2.5 py-0.5 rounded-full border border-green-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Traducido al Inglés
                    </span>
                </td>
                <td class="py-6 px-5 text-gray-600 leading-relaxed line-clamp-2">
                    El comportamiento de búsqueda cambió drásticamente: tus clientes potenciales ya no revisan diez páginas en Google...
                </td>
                <td class="py-6 px-5 text-center">
                    <div class="flex justify-center items-center gap-4 text-sm font-medium">
                        <a href="#" class="text-blue-600 hover:text-blue-900 hover:underline">Ver</a>
                        <a href="#" class="text-amber-600 hover:text-amber-900 hover:underline">Editar</a>
                        <button class="text-red-600 hover:text-red-900 hover:underline">Eliminar</button>
                    </div>
                </td>
            </tr>

            <!-- Fila 2 -->
            <tr class="hover:bg-blue-50/50 transition-colors group">
                <td class="py-6 px-5 font-semibold text-gray-800">2</td>
                <td class="py-6 px-5">
                    <p class="font-bold text-gray-900 leading-snug group-hover:text-blue-800">
                        El nuevo logo de Instagram en 2026: ¿Qué cambió, por qué lo hicieron y qué nos enseña sobre branding?
                    </p>
                    <span class="inline-flex items-center gap-1 mt-1.5 text-xs font-medium text-green-700 bg-green-50 px-2.5 py-0.5 rounded-full border border-green-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Traducido al Inglés
                    </span>
                </td>
                <td class="py-6 px-5 text-gray-600 leading-relaxed line-clamp-2">
                    Meta sorprendió al ecosistema digital con la renovación visual de Instagram. Analizamos los motivos detrás de este cambio histórico...
                </td>
                <td class="py-6 px-5 text-center">
                    <div class="flex justify-center items-center gap-4 text-sm font-medium">
                        <a href="#" class="text-blue-600 hover:text-blue-900 hover:underline">Ver</a>
                        <a href="#" class="text-amber-600 hover:text-amber-900 hover:underline">Editar</a>
                        <button class="text-red-600 hover:text-red-900 hover:underline">Eliminar</button>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>

    <!-- Paginación (Ejemplo visual) -->
    <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100 text-sm text-gray-600">
        <p>Mostrando 2 de 15 entradas</p>
        <div class="flex gap-1">
            <button class="px-3 py-1 border border-gray-200 rounded-lg hover:bg-gray-50 disabled:opacity-50" disabled>&laquo; Anterior</button>
            <button class="px-3 py-1 border border-blue-200 bg-blue-50 text-blue-700 rounded-lg font-semibold">1</button>
            <button class="px-3 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">2</button>
            <button class="px-3 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">3</button>
            <button class="px-3 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Siguiente &raquo;</button>
        </div>
    </div>
</div>
@endsection