<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// web.php

Route::get('/', function () {
    return view('home');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/posts/create1', [PostController::class, 'create'])->name('posts.create1');
Route::post('/posts/create1', [PostController::class, 'store'])->name('posts.store1');
Route::get('/dashboard/NewRequest', [DashboardController::class, 'newrequest'])->name('dashboard/NewRequest');
Route::get('/dashboard/category', [DashboardController::class, 'category'])->name('dashboard/category');
Route::get('/dashboard/service', [DashboardController::class, 'service'])->name('dashboard/service');



// register
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

// login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
