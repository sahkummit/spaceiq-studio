<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\PageController;

// Public Routes
Route::get('/', function () {
    return view('welcome'); // Landing Page
})->name('home');

Route::get('/services/{slug}/{subcategory?}', function ($slug, $subcategory = null) {
    $service = \App\Models\Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
    return view('service', compact('service', 'subcategory'));
})->name('service.show');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\nDisallow: /admin/\nAllow: /\n\nSitemap: " . url('/sitemap.xml');
    return response($content, 200)->header('Content-Type', 'text/plain');
});

Route::get('/sitemap.xml', function () {
    $services = \App\Models\Service::where('is_active', true)->get();
    $pages = \App\Models\Page::where('is_published', true)->get();
    return response()->view('sitemap', compact('services', 'pages'))->header('Content-Type', 'text/xml');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/policies/{slug}', function ($slug) {
    $page = \App\Models\Page::where('slug', $slug)->where('is_published', true)->firstOrFail();
    return view('page', compact('page'));
})->name('page.show');

Route::post('/contact', [InquiryController::class, 'storePublic'])->name('contact.store');

// Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Services CRUD
    Route::resource('services', ServiceController::class);
    
    // Media management
    Route::delete('media/{media}', [\App\Http\Controllers\Admin\MediaController::class, 'destroy'])->name('media.destroy');
    Route::post('media/reorder', [\App\Http\Controllers\Admin\MediaController::class, 'reorder'])->name('media.reorder');
    
    // Inquiries Listing
    Route::get('inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::delete('inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
    
    // Settings Form
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Pages Editor
    Route::get('pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('pages/{page}', [PageController::class, 'update'])->name('pages.update');
});
