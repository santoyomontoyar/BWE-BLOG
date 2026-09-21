<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Iniciar Sesión - Blogs</h2>
        
        <form action="/dashboard" method="GET">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Correo Electrónico</label>
                <input type="email" placeholder="tucorreo@ejemplo.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Contraseña</label>
                <input type="password" placeholder="••••••••" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>
            
            <button type="submit" class="w-full bg-blue-900 text-white font-semibold py-2.5 rounded-lg hover:bg-blue-800 transition">
                Entrar al Dashboard
            </button>
        </form>
    </div>

</body>
</html>