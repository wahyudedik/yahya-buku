<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\BrandingController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\PublicContactController;
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
Route::post('/kontak', [PublicContactController::class, 'submit'])->name('contact.submit');
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

        Route::get('/profile', [CompanyProfileController::class, 'show'])->name('admin.profile.show');
        Route::post('/profile', [CompanyProfileController::class, 'update'])->name('admin.profile.update');

        Route::resource('articles', ArticleController::class, ['as' => 'admin']);
        Route::resource('galleries', GalleryController::class, ['as' => 'admin']);
        Route::resource('careers', CareerController::class, ['as' => 'admin']);
        Route::resource('faqs', FaqController::class, ['as' => 'admin']);

        // Footer Routes
        Route::get('/footer', [FooterController::class, 'index'])->name('admin.footer.index');
        Route::post('/footer/settings', [FooterController::class, 'updateSettings'])->name('admin.footer.settings.update');
        Route::post('/footer/links', [FooterController::class, 'storeLink'])->name('admin.footer.links.store');
        Route::get('/footer/links/{link}/edit', [FooterController::class, 'editLink'])->name('admin.footer.links.edit');
        Route::put('/footer/links/{link}', [FooterController::class, 'updateLink'])->name('admin.footer.links.update');
        Route::delete('/footer/links/{link}', [FooterController::class, 'destroyLink'])->name('admin.footer.links.destroy');

        Route::resource('services', ServiceController::class, ['as' => 'admin']);
        Route::resource('books', BookController::class, ['as' => 'admin']);

        // Contact Settings & Messages Routes
        Route::get('/contact/settings', [ContactController::class, 'showSettings'])->name('admin.contact.settings.show');
        Route::post('/contact/settings', [ContactController::class, 'updateSettings'])->name('admin.contact.settings.update');
        Route::get('/contact/messages', [ContactController::class, 'indexMessages'])->name('admin.contact.messages.index');
        Route::patch('/contact/messages/{message}', [ContactController::class, 'markAsRead'])->name('admin.contact.messages.read');
        Route::delete('/contact/messages/{message}', [ContactController::class, 'deleteMessage'])->name('admin.contact.messages.destroy');
    });
});

require __DIR__ . '/auth.php';
