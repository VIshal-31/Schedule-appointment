<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HolidayController;







//views
Route::get('/', [DomainController::class, 'index'])->name('index');
Route::get('/aboutus', function () {return view('aboutus');});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/posts/create1', [PostController::class, 'create'])->name('posts.create1');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('registerview');
 


// login method
Route::post('/login', [LoginController::class, 'login']);

// register method
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/get-services/{category_id}', [DomainController::class, 'getServices'])->name('get.services');

// Dashboard routes
Route::middleware('auth')->group(function () {
    // Route that requires authentication
    Route::match(['get', 'post'], '/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/requests', [DashboardController::class, 'requests'])->name('dashboard.requests');
    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
    Route::get('/dashboard/services', [ServiceController::class, 'index'])->name('dashboard.services');
    Route::get('/dashboard/shop' , [ShopController::class, 'index'])->name('dashboard.shop');
    // Add more routes as needed...  
    
    
    // Posts routes
    Route::post('/posts/create1', [PostController::class, 'store'])->name('posts.store1');
    

    
    // Form submission route
    Route::post('/submit-form', [PostController::class, 'Enquire'])->name('submit.form');
    
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    
    Route::get('dashborad/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    
    // service store
    Route::post('/categories/services', [ServiceController::class, 'store'])->name('services.store');
    
    // Route to retrieve the edit form for services
    Route::get('dashborad/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    
    // Route to update services
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    
    // Route to delete services
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    
    Route::get('services/{category}', 'ServiceController@getServicesByCategory');

    // Shops table
    Route::post('/shop/login', [ShopController::class, 'saveShop'])->name('save.shop');
    Route::post('/dashboard/shopname', [ShopController::class, 'updateShopName'])->name('update.shop.name');
    Route::post('/dashboard/shopstarttime', [ShopController::class, 'updateShopStartTime'])->name('update.shop.start-time');
    Route::post('/dashboard/shopclosingtime', [ShopController::class, 'updateShopCloseTime'])->name('update.shop.closing-time');
    Route::post('/dashboard/updatedays', [ShopController::class, 'updateDays'])->name('update.shop.workingdays');

    //holidays  
    Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');

    Route::post('/dashboard/shopholidaysfilter', [ShopController::class, 'showFilteredHolidays'])->name('dashboard.showFilteredHolidays');
    
});