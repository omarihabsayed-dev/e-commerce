<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::middleware('admin.guest')->group(function (): void {
            Route::get('/login', 'showLogin')->name('login.form');
            Route::post('/login', 'login')->name('login');

            Route::get('/register', 'showRegister')->name('register.form');
            Route::post('/register', 'store')->name('register');
        });

        Route::middleware('admin.active')->group(function (): void {
            Route::get('/dashboard', 'dashboard')->name('index');
            Route::post('/logout', 'destroy')->name('destroy');
        });
    });

Route::controller(AdminProfileController::class)
    ->prefix('admin/profile')
    ->name('admin.profile.')
    ->middleware('admin.active')
    ->group(function (): void {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
Route::controller(AdminProfileController::class)
    ->prefix('admin/password')
    ->name('admin.password.')
    ->middleware('admin.active')
    ->group(function (): void {
        Route::get('/', 'editPassword')->name('edit');
        Route::patch('/', 'updatePassword')->name('update');
    });

require __DIR__.'/auth.php';
