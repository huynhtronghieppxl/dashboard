<?php

namespace App\Http\Middleware;

use Closure;

class AddCacheControlHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->getStatusCode() === 200) {
            $response->header('Cache-Control', 'max-age=86400, public');
        }

        return $response;
    }
}
