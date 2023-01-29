<?php

use App\Http\Controllers\{
    ProductController,
    ReportsController,
    SaleController
};

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product', ProductController::class)->except('create', 'edit');
Route::resource('sale', SaleController::class)->except('create', 'edit');
Route::get('top-selling-products', [ReportsController::class, 'topSellingProducts']);
Route::get('least-sold-products', [ReportsController::class, 'leastSoldProducts']);
Route::get('average-sale', [ReportsController::class, 'averageSale']);
Route::get('sum-of-day-sales', [ReportsController::class, 'sumOfDaySales']);
