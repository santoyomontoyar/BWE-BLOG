<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Blog</title>
    <!-- Usamos Tailwind CSS para estilizar rápido -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <!-- BARRA LATERAL AZUL -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col justify-between p-6 shadow-md">
        <div>
            <h1 class="text-2xl font-bold mb-8 tracking-wider">BLOGS</h1>
            <nav class="space-y-2">
                <a href="#" class="block py-2.5 px-4 rounded transition bg-blue-800 font-semibold">+ New Blog</a>
                <a href="/dashboard" class="block py-2.5 px-4 rounded transition hover:bg-blue-800">Dashboard</a>
                <a href="#" class="block py-2.5 px-4 rounded transition hover:bg-blue-800">Categories</a>
            </nav>
        </div>
        <div>
            <a href="/login" class="block py-2.5 px-4 rounded text-red-300 hover:bg-blue-800 transition font-medium">Cerrar Sesión</a>
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL DINÁMICO -->
    <main class="flex-1 overflow-y-auto p-10">
        @yield('content')
    </main>

</body>
</html>