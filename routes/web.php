<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('categories', CategoryController::class)->except(['show']);
      Route::resource('posts', PostController::class)->except(['show']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
