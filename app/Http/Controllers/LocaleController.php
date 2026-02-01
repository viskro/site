<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    public function setLocale(Request $request)
    {
        $locale = $request->input('locale');

        if (!in_array($locale, ['fr', 'en'])) {
            return response()->json(['error' => 'Locale invalide'], 400);
        }

        app()->setLocale($locale);

        // Retourner une réponse avec le cookie
        return response()->json(['success' => true, 'locale' => $locale])
            ->cookie('locale', $locale, 60 * 24 * 365); // Cookie valide 1 an
    }
}
