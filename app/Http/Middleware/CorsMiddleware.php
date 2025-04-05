<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        // اطمینان از استفاده صحیح از شیء Response
        if ($response instanceof Response) {
            $response->header('Access-Control-Allow-Origin', '*')
                     ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT')
                     ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Authorization, Origin');
        }
        return $response;
    }
}
