<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;



Route::get('/', HomeController::class)->name('home');

Route::controller(LanguageController::class)->group(function () {

    Route::get('/language/{locale}', 'setLanguage')->name('language.switch');
    Route::get('/i18n/{locale?}', 'getLanguageFiles')->name('i18n.index');
});
