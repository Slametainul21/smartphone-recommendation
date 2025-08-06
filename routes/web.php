<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Recommendation Routes
Route::get('/recommendation', [RecommendationController::class, 'showForm'])->name('recommendation.form');
Route::post('/recommendation/result', [RecommendationController::class, 'getRecommendation'])->name('recommendation.result');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin Authentication (tanpa middleware)
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Dashboard (dengan middleware langsung menggunakan class)
Route::middleware([AdminAuth::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Categories CRUD
    Route::resource('/admin/categories', \App\Http\Controllers\Admin\CategoryController::class, [
        'as' => 'admin'
    ]);
    
    // Smartphones CRUD
    Route::resource('/admin/smartphones', \App\Http\Controllers\Admin\SmartphoneController::class, [
        'as' => 'admin'
    ]);
    // Specifications CRUD
    Route::resource('/admin/specifications', \App\Http\Controllers\Admin\SpecificationController::class, [
        'as' => 'admin'
    ]);
});

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
*/

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection successful!";
    } catch (\Exception $e) {
        return "Database connection failed: " . $e->getMessage();
    }
});