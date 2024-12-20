<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthPartner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $contentType = $request->header('Content-type');
        $authorization = $request->header('Authorization');
        $headers['Content-type'] = $contentType ?? 'application/json';
        $headers['Authorization'] = $authorization ?? '';
        $request->merge(['headers' => $headers]);
        return $next($request);
    }
}
