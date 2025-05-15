<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::prefix('user')->name('user.')->group(function() {
    Route::resource('posts', UserController::class)->except(['show']);
    Route::get('posts/{id}', [UserController::class, 'show'])->name('posts.show');
    Route::post('posts/{id}', [UserController::class, 'storeComment'])->name('posts.comments.store');
    Route::delete('posts/{postId}/comments/{commentId}', [UserController::class, 'destroyComment'])->name('posts.comments.destroy');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
