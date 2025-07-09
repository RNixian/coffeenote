<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\UserController;

// Sidebar view
Route::get('/', [SetupController::class, 'index'])->name('index');

// Sidebar view
Route::get('/header', [SetupController::class, 'header'])->name('header');

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


// ADD TO READ
Route::get('/add-to-read', [ReadController::class, 'addtoread'])->name('addtoread');

Route::prefix('addtoread')->name('addtoread.')->group(function () {
Route::post('/add-to-read', [ReadController::class, 'storetoread'])->name('store');
});

Route::get('/read', [ReadController::class, 'read'])->name('read');

Route::prefix('addtoread')->name('addtoread.')->group(function () {
Route::post('/add-to-read', [ReadController::class, 'storetoread'])->name('store');
});


Route::prefix('read')->name('read.')->group(function () {
Route::get('/delete/{id}', [ReadController::class, 'deletenote'])->name('delete');
  Route::get('/edit/{id}', [ReadController::class, 'editnote'])->name('edit');
    Route::put('/update/{id}', [ReadController::class, 'updatenote'])->name('update');
Route::get('/full-update/{id}', [ReadController::class, 'fullupdate'])->name('fullupdate');
});







