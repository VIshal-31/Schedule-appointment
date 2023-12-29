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

Route::get('/dashboard', 'DashboardController@index'); 
Route::get('/posts/create1', [PostController::class, 'create'])->name('posts.create1');
Route::post('/posts/create1', [PostController::class, 'store'])->name('posts.store1');
Route::get('/dashboard/NewRequest', [DashboardController::class, 'newrequest'])->name('dashboard/NewRequest');
Route::get('/dashboard/category', [DashboardController::class, 'category'])->name('dashboard/category');
Route::get('/dashboard/service', [DashboardController::class, 'service'])->name('dashboard/service');


// Login form view
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Handling login
Route::post('/login', [LoginController::class, 'login']);




// register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('registerview');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    // Routes that require authentication
    Route::get('/dashboard', 'DashboardController@index'); // Authenticated route
});

Route::middleware('auth')->group(function () {
    // Routes that require authentication
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::match(['get', 'post'], '/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

// form
Route::post('/submit-form', [PostController::class, 'Enquire'])->name('submit.form');