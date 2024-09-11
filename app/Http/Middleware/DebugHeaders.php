<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DebugHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $start_time = microtime(true);
        $start_memory = memory_get_usage();


        $response = $next($request);


        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time) * 1000;
        $end_memory = memory_get_usage();
        $memory_usage = ($end_memory - $start_memory) / 1024;


        $response->headers->set('X-Debug-Time', $execution_time . ' ms');
        $response->headers->set('X-Debug-Memory', $memory_usage . ' KB');

        return $response;
    }
}
