<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::controller(BrandController::class)
    ->prefix('admin/brands')
    ->name('admin.brands.')
    ->middleware('admin.active')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('/{brand}/edit', 'edit')->name('edit');
        Route::patch('/{brand}', 'update')->name('update');
        Route::delete('/{brand}', 'destroy')->name('destroy');
        Route::post('/', 'store')->name('store');
    });

Route::controller(CategoryController::class)
    ->prefix('admin/categories')
    ->name('admin.categories.')
    ->middleware('admin.active')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('/{category}/edit', 'edit')->name('edit');
        Route::patch('/{category}', 'update')->name('update');
        Route::delete('/{category}', 'destroy')->name('destroy');
        Route::post('/', 'store')->name('store');
    });

Route::controller(SubCategoryController::class)
    ->prefix('admin/subcategories')
    ->name('admin.subcategories.')
    ->middleware('admin.active')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('/{subcategory}/edit', 'edit')->name('edit');
        Route::patch('/{subcategory}', 'update')->name('update');
        Route::delete('/{subcategory}', 'destroy')->name('destroy');
        Route::post('/', 'store')->name('store');
    });

Route::controller(SubSubCategoryController::class)
    ->prefix('admin/subsubcategories')
    ->name('admin.subsubcategories.')
    ->middleware('admin.active')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('/{subsubcategory}/edit', 'edit')->name('edit');
        Route::patch('/{subsubcategory}', 'update')->name('update');
        Route::delete('/{subsubcategory}', 'destroy')->name('destroy');
        Route::post('/', 'store')->name('store');
    });

Route::controller(ProductController::class)
    ->prefix('admin/products')
    ->name('admin.products.')
    ->middleware('admin.active')
    ->group(function (): void {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{product}/edit', 'edit')->name('edit');
        Route::patch('/{product}', 'update')->name('update');
        Route::patch('/{product}/toggle-status', 'toggleStatus')->name('toggle-status');
        Route::delete('/{product}', 'destroy')->name('destroy');
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
Route::controller(IndexController::class)->group(function (): void {
    Route::get('/', 'index')->name('index');
});

require __DIR__.'/auth.php';
