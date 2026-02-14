<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\BrandingController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Static Pages Routes
Route::get('/ruang-tulisan', [PageController::class, 'ruangTulisan'])->name('ruang-tulisan');
Route::get('/ruang-tulisan/{slug}', [PageController::class, 'showArticle'])->name('article.show');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/toko', [PageController::class, 'toko'])->name('toko');
Route::get('/toko/{slug}', [PageController::class, 'showBook'])->name('book.show');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/karir', [PageController::class, 'karir'])->name('karir');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->group(function () {
        Route::get('/branding', [BrandingController::class, 'show'])->name('admin.branding.show');
        Route::post('/branding', [BrandingController::class, 'update'])->name('admin.branding.update');
        Route::post('/branding/reset', [BrandingController::class, 'reset'])->name('admin.branding.reset');

        Route::get('/hero', [HeroController::class, 'show'])->name('admin.hero.show');
        Route::post('/hero', [HeroController::class, 'update'])->name('admin.hero.update');

        Route::resource('articles', ArticleController::class, ['as' => 'admin']);
        Route::resource('services', ServiceController::class, ['as' => 'admin']);
        Route::resource('books', BookController::class, ['as' => 'admin']);
    });
});

require __DIR__ . '/auth.php';
