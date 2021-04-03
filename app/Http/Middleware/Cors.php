<?php
namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

     public function handle($request, Closure $next)
     {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', env('CORS_ORIGIN','localhost:3000'));
        $response->headers->set('Access-Control-Allow-Methods', 'GET, HEAD, POST, PUT, DELETE, OPTIONS, PATCH');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        return $response;
     }
}
