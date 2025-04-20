<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class StripQueryParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $nonEmpty = array_filter($request->input(), function ($value) {
            return $value !== '' && $value !== null;
        });

        if (count($request->input()) !== count($nonEmpty)) {
            return redirect(
                url($request->path()) . (count($nonEmpty) > 0 ? '?' . http_build_query($nonEmpty) : '')
            );
        }

        return $next($request);
    }
}
