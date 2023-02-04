<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [CategoryController::class, 'categoryAll'])->name('home');

Route::get('/category/{category_slug}', [CategoryController::class, 'CategorySearch'])->name('category.slug');
Route::get('/book/{slug}', [BookController::class, 'show'])->name('book.slug');

