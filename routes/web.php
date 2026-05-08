<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminBlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Frontend Routes
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/blog/{id}', [HomePageController::class, 'show'])->name('blog.detail');

// AJAX Filter Routes
Route::get('/filter-category', [HomePageController::class, 'filterByCategory'])->name('filter.category');
Route::get('/filter-date', [HomePageController::class, 'filterByDate'])->name('filter.date');
Route::get('/search', [HomePageController::class, 'search'])->name('search');

// Admin Authentication Routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard - Protected Routes
Route::middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminBlogController::class, 'index'])->name('admin.dashboard');
    
    // Blog Management
    Route::get('/admin/blog/create', [AdminBlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/admin/blog/store', [AdminBlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/admin/blog/{id}/edit', [AdminBlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('/admin/blog/{id}/update', [AdminBlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/admin/blog/{id}', [AdminBlogController::class, 'destroy'])->name('admin.blog.delete');
});
