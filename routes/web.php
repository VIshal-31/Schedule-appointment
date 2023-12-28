<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/posts/create1', [PostController::class, 'create'])->name('posts.create1');
Route::post('/posts/create1', [PostController::class, 'store'])->name('posts.store1');
