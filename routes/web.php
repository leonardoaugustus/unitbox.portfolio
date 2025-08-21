<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('LandingPage');
})->name('home');

// Ruta para cambiar el idioma
Route::get('/language/{locale}', function ($locale) {

    if (in_array($locale, ['en', 'pt_BR'])) {
        Session::put('locale', $locale);
    }

    return redirect()->back();
})->name('language.switch');


// API simples para retornar todas as traduções do locale solicitado
Route::get('/i18n/{locale?}', function ($locale = null) {

    $available = ['en', 'pt_BR'];
    $locale = $locale ?: Session::get('locale', 'en');
    if (!in_array($locale, $available, true)) {
        $locale = 'en';
    }

    // fixa locale na App para manter consistência
    App::setLocale($locale);

    // carrega traduções
    $messages = loadTranslations($locale);

    // opcional: também envia o "fallback" (ex.: inglês) para fallback no client
    $fallback = 'en';
    $fallbackMessages = $locale !== $fallback ? loadTranslations($fallback) : [];

    return response()->json([
        'locale' => $locale,
        'messages' => $messages,
        'fallback' => $fallback,
        'fallbackMessages' => $fallbackMessages,
    ]);
})->name('i18n.index');

function loadTranslations(string $locale): array
{
    $basePath = resource_path("lang/{$locale}");
    $allowed = ['hero', 'navbar', 'footer']; // só estes arquivos vão para o front
    $translations = [];

    foreach ($allowed as $group) {
        $file = "{$basePath}/{$group}.php";
        if (is_file($file)) {
            $data = require $file;
            if (is_array($data)) {
                $translations[$group] = $data;
            }
        }
    }

    return $translations;
}

function setLocaleFromSession()
{
    $locale = Session::get('locale', 'en');
    App::setLocale($locale);
    return $locale;
}
