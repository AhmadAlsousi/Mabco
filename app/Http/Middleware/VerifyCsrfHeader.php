<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Hash;

class VerifyCsrfHeader
{
    public function handle(Request $request, Closure $next)
    {
        // جلب التوكن من Header
       $token = $request->header('X-CSRF-TOKEN');

    if (!$token || !Cache::has('csrf_'.$token)) {
        return response()->json([
            'message' => 'Invalid or expired CSRF token',
            'status' => 419
        ], 419);
    }

    // حذف التوكن بعد أول استخدام
    Cache::forget('csrf_'.$token);

    return $next($request);

    }
}