<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** Get Locale */
        $locale = Locale();

        /** Get URL Locale and redirect if not supported */
        $currentPath = $request->path();
        if (!preg_match("#^$locale(/|$)#", $currentPath)) {
            return redirect("/$locale/$currentPath");
        }

        /** App settings */
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
