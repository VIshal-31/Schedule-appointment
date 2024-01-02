<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;


// Home and aboutus routes
Route::get('/', function () {
    return view('home');
});

Route::get('/aboutus', function () {
    return view('aboutus');
});

// Dashboard routes
Route::middleware('auth')->group(function () {
    // Route that requires authentication
    Route::match(['get', 'post'], '/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/requests', [DashboardController::class, 'requests'])->name('dashboard.requests');
    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
    Route::get('/dashboard/services', [ServiceController::class, 'index'])->name('dashboard.services');
    // Add more routes as needed...
});

// Posts routes
Route::get('/posts/create1', [PostController::class, 'create'])->name('posts.create1');
Route::post('/posts/create1', [PostController::class, 'store'])->name('posts.store1');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('registerview');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Form submission route
Route::post('/submit-form', [PostController::class, 'Enquire'])->name('submit.form');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
