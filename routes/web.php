<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;

// Sidebar view
Route::get('/sidebar', [SetupController::class, 'sidebar'])->name('sidebar');

// Setup main + search
Route::get('/setup', [SetupController::class, 'setup'])->name('setup');

// CATEGORY ROUTES
Route::prefix('category')->name('category.')->group(function () {
    Route::post('/store', [SetupController::class, 'storecategory'])->name('store');
    Route::get('/delete/{id}', [SetupController::class, 'deletecategory'])->name('delete');
    Route::get('/edit/{id}', [SetupController::class, 'editcategory'])->name('edit');
    Route::put('/update/{id}', [SetupController::class, 'updatecategory'])->name('update');
});

// GENRE ROUTES
Route::prefix('genre')->name('genre.')->group(function () {
    Route::post('/store', [SetupController::class, 'storegenre'])->name('store');
    Route::get('/delete/{id}', [SetupController::class, 'deletegenre'])->name('delete');
    Route::get('/edit/{id}', [SetupController::class, 'editgenre'])->name('edit');
    Route::put('/update/{id}', [SetupController::class, 'updategenre'])->name('update');
});
