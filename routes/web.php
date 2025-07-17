<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\UserController;

// front view
Route::get('/index', [SetupController::class, 'index'])->name('index');

// headers view
Route::get('/header', [SetupController::class, 'header'])->name('header');

// SETUP CATEGORY
Route::get('/setup-category', [SetupController::class, 'setupcategory'])->name('category');

// CATEGORY ROUTES
Route::prefix('category')->name('category.')->group(function () {
    Route::post('/store', [SetupController::class, 'storecategory'])->name('store');
    Route::get('/delete/{id}', [SetupController::class, 'deletecategory'])->name('delete');
    Route::get('/edit/{id}', [SetupController::class, 'editcategory'])->name('edit');
    Route::put('/update/{id}', [SetupController::class, 'updatecategory'])->name('update');
});

// SETUP GENRE
Route::get('/setup-genre', [SetupController::class, 'setupgenre'])->name('genre');

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

Route::get('/fullviewedit', [ReadController::class, 'fullviewedit'])->name('fullviewedit');

Route::prefix('read')->name('read.')->group(function () {
Route::get('/delete/{id}', [ReadController::class, 'deletenote'])->name('delete');
  Route::get('/edit/{id}', [ReadController::class, 'editnote'])->name('edit');
    Route::put('/update/{id}', [ReadController::class, 'updatenote'])->name('update');
    Route::get('/fulledit', [ReadController::class, 'fulledit'])->name('fulledit');
Route::put('/full-update/{id}', [ReadController::class, 'fullupdate'])->name('fullupdate');
});

Route::get('/read/reset-filters', function () {
    session()->forget(['search', 'category', 'genre', 'letter']);
    return redirect()->route('read');
});




Route::get('/', [ReadController::class, 'dashread'])->name('dashread');






