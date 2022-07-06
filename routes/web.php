<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/view-posts', [PostController::class, 'index'])->name('view_posts');
Route::get('/create-post', [PostController::class, 'create'])->name('create_post');
Route::post('/save-post', [PostController::class, 'store'])->name('store_post');
Route::get('/edit-post', [PostController::class, 'edit'])->name('edit_post');
Route::post('/update-post', [PostController::class, 'update'])->name('update_post');
Route::get('/delete-post/{slug}', [PostController::class, 'destroy'])->name('delete_post');