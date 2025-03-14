<?php

namespace App\Http\Controllers;

class LocalizationController extends Controller
{
    public function __invoke($locale) {
        if (!in_array($locale, array_keys(config('localization.locales')))) {
            abort(400);
        }

        session(['localization' => $locale]);

        return redirect()->back();
    }
}
