<?php

use App\Http\Controllers\PublicationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Static pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');
Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Test upload route
Route::get('/upload-test', function () {
    return view('upload');
})->name('upload.form');
Route::post('/upload-test', [\App\Http\Controllers\UploadController::class, 'upload'])->name('upload.test');

// Search routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/publications/suggestions', [PublicationController::class, 'suggestions'])->name('publications.suggestions');
Route::get('/users/suggestions', [UserController::class, 'suggestions'])->name('users.suggestions');

// Authentication routes
require __DIR__.'/auth.php';

// Protected routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Publication routes
    Route::resource('publications', PublicationController::class);
    Route::get('/publications/{publication}/download', [PublicationController::class, 'download'])->name('publications.download');
    
    // User management routes (admin only)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});