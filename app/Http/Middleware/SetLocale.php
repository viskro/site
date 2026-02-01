<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        // Vérifier d'abord le cookie de langue
        $locale = $request->cookie('locale');

        // Si pas de cookie, utiliser la locale par défaut
        if (!$locale || !in_array($locale, ['fr', 'en'])) {
            $locale = config('app.locale', 'fr');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
