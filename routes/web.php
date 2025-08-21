<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;


// Función para establecer el idioma basado en la sesión o usar el predeterminado
function setLocaleFromSession()
{
    $locale = Session::get('locale', 'en');
    App::setLocale($locale);
    return $locale;
}


function loadTranslations(string $locale): array
{
    // ✅ usa lang_path() em vez de resource_path()
    $basePath = lang_path($locale);
    $translations = [];

    if (!is_dir($basePath)) {
        return $translations;
    }

    // Carrega todos os arquivos PHP (ex.: hero.php, navbar.php, etc.)
    foreach (glob($basePath . '/*.php') as $file) {
        $group = basename($file, '.php'); // nome do arquivo vira o "grupo" (ex.: hero)
        $data = require $file;
        if (is_array($data)) {
            $translations[$group] = $data;
        }
    }

    return $translations;
}

// Ruta para cambiar el idioma
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'pt_BR'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('language.switch');

Route::get('/', function () {
    return Inertia::render('LandingPage');
})->name('home');


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
