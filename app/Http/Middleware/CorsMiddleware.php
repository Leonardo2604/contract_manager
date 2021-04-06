<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CorsMiddleware
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
        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods'=> 'GET, POST, DELETE, PUT, OPTIONS, HEAD, PATCH',
            'Access-Control-Allow-Headers'=> 'Authorization,DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Set-Cookie',
            'Access-Control-Allow-Credentials'=> 'true'
        ];

        if($request->getMethod() == "OPTIONS") {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return response()->json('OK', 200, $headers);
        }

        $response = $next($request);

        if (!($response instanceof BinaryFileResponse)) {
            foreach($headers as $key => $value) {
                $response->header($key, $value);
            }
        }

        return $response;
    }
}
