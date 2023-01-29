<?php

use App\Http\Controllers\{
    ProductController,
    ReportsController,
    SaleController
};

use Illuminate\Support\Facades\Route;

Route::get('/', [ReportsController::class, 'index']);
Route::resource('product', ProductController::class)->except('create', 'edit');
Route::resource('sale', SaleController::class)->except('create', 'edit');
