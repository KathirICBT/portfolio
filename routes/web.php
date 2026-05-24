<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\{
    AuthController, DashboardController, SliderController,
    ServiceController, NetworkProfileController, ClientController,
    TestimonialController, StatController, SectionController,
    MediaController, SeoController, SettingController, GalleryController,CategoryController,ProductController
};
use Illuminate\Support\Facades\Route;

/* ── Public / Front ───────────────────────────────────────────────────── */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.submit');
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [HomeController::class, 'robots'])->name('robots');





/* ── Admin Auth (guest) ───────────────────────────────────────────────── */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    /* ── Admin Protected ──────────────────────────────────────────────── */
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Sliders
        Route::resource('sliders', SliderController::class);
        Route::patch('sliders/{slider}/toggle', [SliderController::class, 'toggle'])->name('sliders.toggle');
        Route::post('sliders/reorder', [SliderController::class, 'reorder'])->name('sliders.reorder');

        // Services
        Route::resource('services', ServiceController::class);

        // Network Profiles
        Route::resource('network-profiles', NetworkProfileController::class);

        // Clients
        Route::resource('clients', ClientController::class);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);

        // Gallery
        Route::resource('gallery', GalleryController::class);

        // Stats
        Route::get('stats', [StatController::class, 'index'])->name('stats.index');
        Route::patch('stats/{stat}', [StatController::class, 'update'])->name('stats.update');

        // Page Sections
        Route::get('sections', [SectionController::class, 'index'])->name('sections.index');
        Route::get('sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit');
        Route::patch('sections/{section}', [SectionController::class, 'update'])->name('sections.update');

        // Media
        Route::get('media', [MediaController::class, 'index'])->name('media.index');
        Route::post('media', [MediaController::class, 'store'])->name('media.store');
        Route::patch('media/{medium}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');

        // SEO
        Route::get('seo', [SeoController::class, 'edit'])->name('seo.edit');
        Route::patch('seo', [SeoController::class, 'update'])->name('seo.update');

        // Settings
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::patch('settings', [SettingController::class, 'update'])->name('settings.update');

        //Category
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        

        
    });
});

Route::get('/products', [ProductController::class, 'viewproducts'])
    ->name('products.view');

