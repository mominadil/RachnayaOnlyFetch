<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\authorController;
use App\Http\Controllers\publisherController;
use App\Http\Controllers\searchController;


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

Route::get('/search', [searchController::class, 'search'])->name('search');
Route::get('/category/{category_slug}', [CategoryController::class, 'CategorySearch'])->name('category.slug');
Route::get('/book/{slug}', [BookController::class, 'show'])->name('book.slug');
Route::get('/author/{author_id}', [authorController::class, 'show'])->name('author.author_id');
Route::get('/publisher/{publisher_id}', [publisherController::class, 'show'])->name('publisher.publisher_id');


Route::get('/clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('clear-compiled');
    \Artisan::call('config:cache');
    dd("Cache is cleared");
});