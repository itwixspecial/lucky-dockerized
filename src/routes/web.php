<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LuckyController;
use App\Http\Controllers\GameHistoryController;
use App\Http\Controllers\UniqueLinkController;

Route::get('/', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/', [RegistrationController::class, 'register']);
Route::get('/registration-success', function () {
    return view('registration-success');
})->name('registration-success');


Route::get('/generate-link', [UniqueLinkController::class, 'generate'])->name('generate.link');


Route::get('/page-a/{link}', [UniqueLinkController::class, 'show'])->name('page-a');
Route::post('/page-a/{link}/regenerate', [UniqueLinkController::class, 'regenerate'])->name('regenerate.link');
Route::post('/page-a/{link}/deactivate', [UniqueLinkController::class, 'deactivate'])->name('deactivate.link');
Route::get('/page-a/{link}/game', [LuckyController::class, 'imFeelingLucky'])->name('imfeelinglucky');
Route::get('/page-a/{link}/history', [GameHistoryController::class, 'index'])->name('history');
