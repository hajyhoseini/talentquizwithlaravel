<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckReferrerAuthType
{
    public function handle(Request $request, Closure $next)
    {
        $referrer = $request->headers->get('referer');
        $host = $request->getHost(); // هاست سایت خودت

        if ($referrer && !str_contains($referrer, $host)) {
            // رفرر وجود داره ولی از سایت خودمون نیست (ریدایرکت از بیرون)
            session(['auth_type' => 'external']);
        } else {
            // رفرر وجود نداره یا از سایت خودمونه
            session(['auth_type' => 'internal']);
        }

        return $next($request);
    }
}
