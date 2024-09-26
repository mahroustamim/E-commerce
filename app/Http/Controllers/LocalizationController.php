<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function setlocale(string $locale) {
        if (!in_array($locale, ['en', 'ar'])) {
            abort(404);  // Use 404 instead of 400
        }
        
        session(['locale' => $locale]);
        app()->setLocale($locale);
    
        return redirect()->back();
    }
}
