<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin Access Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/posts', [DashboardController::class, 'posts'])->name('dashboard.posts');
    Route::get('dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');

    // CRUD Dashboard Route
    Route::post('dashboard/posts', [DashboardController::class, 'create'])->name('dashboard.posts.create');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Route group member
Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('/home/anime/detail/{id}', [HomeController::class, 'detail'])->name('home.anime.detail');
});

require __DIR__ . '/auth.php';
