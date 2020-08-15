<?php

namespace App\Http\Middleware;

use Closure;

class JSONRequest
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
        $headers = $request->headers->all();
        if(isset($headers['content-type']) && in_array('application/json', $headers['content-type'])) {
            return $next($request);
        } else {
            return response()->json(['error' => "Request should have 'Content-Type' header with value 'application/json'"], 401);
        }
    }
}
