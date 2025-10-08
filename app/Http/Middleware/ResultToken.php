<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResultToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $time = Carbon::now()->toDateTimeString();
        $url = $request->fullUrl();
        $method = $request ->method();
        Log::info("Reques[$method] $url", [
            'ip' => $ip,
            'time' => $time,
            'url' => $url,

        ]);

        return $next($request);
    }
}
