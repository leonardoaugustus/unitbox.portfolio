<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLanguage(string $locale)
    {
        if (in_array($locale, ['en', 'pt_BR'])) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }

    public function getLanguageFiles(?string $locale = null)
    {
        $available = ['en', 'pt_BR'];
        $locale = $locale ?: Session::get('locale', 'en');
        if (!in_array($locale, $available, true)) {
            $locale = 'en';
        }

        App::setLocale($locale);

        $messages = $this->loadTranslations($locale);

        $fallback = 'en';
        $fallbackMessages = $locale !== $fallback ? $this->loadTranslations($fallback) : [];

        return response()->json([
            'locale' => $locale,
            'messages' => $messages,
            'fallback' => $fallback,
            'fallbackMessages' => $fallbackMessages,
        ]);
    }

    private function loadTranslations(string $locale): array
    {
        $basePath = resource_path("lang/{$locale}");
        $translations = [];

        foreach (glob("{$basePath}/*.php") as $file) {
            $group = basename($file, '.php');
            $data = require $file;

            if (is_array($data)) {
                $translations[$group] = $data;
            }
        }

        return $translations;
    }
}
