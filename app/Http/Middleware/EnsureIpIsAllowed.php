<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AllowedIps;

class EnsureIpIsAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIps = AllowedIps::select('ip')
            ->where('enabled', 1)
            ->get();
        $allowedIps = $allowedIps->pluck('ip')->all();
        if (in_array($request->ip(), $allowedIps)) {
            return $next($request);
        }
        return response()->view('403');
    }
}
