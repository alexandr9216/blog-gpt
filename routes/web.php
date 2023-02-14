<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
Route::post('/categories/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
Route::get('/categories/edit/{category}', [\App\Http\Controllers\CategoryController::class, 'edit'])->where('category', '[0-9]+')->name('category.edit');
Route::put('/categories/update/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->where('category', '[0-9]+')->name('category.update');
Route::delete('/categories/destroy/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->where('category', '[0-9]+')->name('category.destroy');
Route::get('/categories/single/{category}', [\App\Http\Controllers\CategoryController::class, 'single'])->where('category', '[0-9]+')->name('category.single');
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::delete('/categories/update-multiple', [\App\Http\Controllers\CategoryController::class, 'destroyMultiple'])->name('category.update-multiple');
Route::put('/categories/update-multiple', [\App\Http\Controllers\CategoryController::class, 'updateMultiple'])->name('category.update-multiple');

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/posts/store', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::get('/posts/edit/{post}', [\App\Http\Controllers\PostController::class, 'edit'])->where('post', '[0-9]+')->name('post.edit');
Route::put('/posts/update/{post}', [\App\Http\Controllers\PostController::class, 'update'])->where('post', '[0-9]+')->name('post.update');
Route::delete('/posts/destroy/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->where('post', '[0-9]+')->name('post.destroy');

