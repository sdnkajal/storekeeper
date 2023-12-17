<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
//    $todaySales = Sale::whereDate('created_at', today())->sum('total_price');
//    $yesterdaySales = Sale::whereDate('created_at', today()->subDay())->sum('total_price');
//    $thisMonthSales = Sale::whereMonth('created_at', today()->month)->sum('total_price');
//    $lastMonthSales = Sale::whereMonth('created_at', today()->subMonth())->sum('total_price');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}/edit', [ProductController::class, 'update'])->name('products.update');

    // Sales
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/{id}/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales/{id}/create', [SaleController::class, 'store'])->name('sales.store');
//    Route::get('/sales/{id}/edit', [SaleController::class, 'edit'])->name('sales.edit');
//    Route::put('/sales/{id}/edit', [SaleController::class, 'update'])->name('sales.update');
});

require __DIR__.'/auth.php';
