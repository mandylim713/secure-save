<?php

use App\Http\Controllers\AutoTaskController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

// Cron url
Route::get('/cron', [AutoTaskController::class, 'autotopup'])->name('cron');

// Front Pages Routes
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('about', [HomePageController::class, 'about'])->name('about');
Route::get('business', [HomePageController::class, 'business'])->name('business');
Route::get('personal', [HomePageController::class, 'personal'])->name('personal');
Route::get('loans', [HomePageController::class, 'loans'])->name('loans');
Route::get('cards', [HomePageController::class, 'cards'])->name('cards');
Route::get('contact', [HomePageController::class, 'contact'])->name('contact');
Route::get('faq', [HomePageController::class, 'faq'])->name('faq');
Route::get('terms', [HomePageController::class, 'terms'])->name('terms');
Route::get('terms-of-service', [HomePageController::class, 'terms'])->name('terms.alias');
Route::get('privacy', [HomePageController::class, 'privacy'])->name('privacy');
Route::get('privacy-policy', [HomePageController::class, 'privacy'])->name('privacy.alias');

// Institutional & Nav Aliases
Route::get('accounts', [HomePageController::class, 'personal'])->name('accounts');
Route::get('savings', [HomePageController::class, 'personal'])->name('savings');
Route::get('invest', [HomePageController::class, 'business'])->name('invest');
Route::get('rates', [HomePageController::class, 'loans'])->name('rates');
Route::get('calculators', [HomePageController::class, 'loans'])->name('calculators');
Route::get('payments', [HomePageController::class, 'personal'])->name('payments');
Route::get('bills', [HomePageController::class, 'business'])->name('bills');
Route::get('help', [HomePageController::class, 'contact'])->name('help');
Route::get('security', [HomePageController::class, 'about'])->name('security');
Route::get('send-money', [HomePageController::class, 'loans'])->name('sendmoney');
Route::get('alerts', [HomePageController::class, 'business'])->name('alerts');
Route::get('chart', [HomePageController::class, 'loans'])->name('chart');

// Redirection for legacy mobile app URLs to homepage
Route::get('apps', function() { return redirect('/'); })->name('app');
Route::get('app', function() { return redirect('/'); })->name('app.alias');

// Verification / Contact post routes
Route::get('verify', [HomePageController::class, 'verify'])->name('verify');
Route::post('homesendcontact', [HomePageController::class, 'homesendcontact'])->name('homesendcontact');
Route::post('codeverify', [HomePageController::class, 'codeverify'])->name('codeverify');
