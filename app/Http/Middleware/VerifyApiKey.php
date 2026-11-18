<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $expected = config('services.blog_api.key');
        $provided = $request->header('X-API-KEY');

        if (empty($expected) || ! is_string($provided) || ! hash_equals($expected, $provided)) {
            return response()->json([
                'message' => 'No autorizado. Se requiere una llave de API válida.',
            ], 401);
        }

        return $next($request);
    }
}