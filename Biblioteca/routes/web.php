<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

// Rota principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas para os recursos (CRUDs)
Route::resource('books', BookController::class);
Route::resource('authors', AuthorController::class);
Route::resource('categories', CategoryController::class);

// Rota de fallback
Route::fallback(function () {
    return redirect()->route('home');
});