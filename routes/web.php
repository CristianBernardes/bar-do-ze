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
Route::get('reports', [ReportsController::class, 'index']);
