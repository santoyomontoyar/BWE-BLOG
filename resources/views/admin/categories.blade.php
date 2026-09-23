@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto pb-12">
    <!-- Encabezado superior -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestión de Categorías</h2>
            <p class="text-sm text-gray-500 mt-1">Administra las etiquetas y categorías para clasificar tus entradas del blog.</p>
        </div>
        <a href="/dashboard" class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-50 transition shadow-sm">
            &larr; Volver al Dashboard
        </a>
    </div>

    <!-- Alerta de éxito -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Layout en dos columnas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- COLUMNA IZQUIERDA: Formulario para Nueva Categoría -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-fit">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Nueva Categoría</h3>
            
            <form action="/categories" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nombre de la Categoría</label>
                    <input type="text" name="name" required placeholder="Ej. Inteligencia Artificial..." 
                           class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Slug (URL amigable)</label>
                    <input type="text" name="slug" required placeholder="ej. inteligencia-artificial" 
                           class="w-full border border-gray-200 bg-gray-50 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2.5 rounded-xl text-sm shadow-md transition">
                    Crear Categoría
                </button>
            </form>
        </div>

        <!-- COLUMNA DERECHA: Tabla de Categorías Registradas -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900">Categorías Existentes</h3>
                <span class="text-xs font-semibold bg-blue-50 text-blue-700 px-3 py-1 rounded-full">{{ $categories->count() }} Registradas</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-400 text-xs uppercase tracking-wider border-b border-gray-100">
                            <th class="py-3 px-5 font-bold">No.</th>
                            <th class="py-3 px-5 font-bold">Nombre</th>
                            <th class="py-3 px-5 font-bold">Slug</th>
                            <th class="py-3 px-5 text-center font-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-50 text-gray-700">
                        @forelse($categories as $index => $category)
                        <tr class="hover:bg-blue-50/50 transition-colors">
                            <td class="py-4 px-5 font-semibold text-gray-800">{{ $index + 1 }}</td>
                            <td class="py-4 px-5 font-bold text-gray-900">{{ $category->name }}</td>
                            <td class="py-4 px-5 text-gray-500 font-mono text-xs">{{ $category->slug }}</td>
                            <td class="py-4 px-5 text-center space-x-2">
                                <form action="/categories/{{ $category->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')" class="text-red-500 hover:underline font-semibold text-xs">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-400 text-sm">No hay categorías registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection