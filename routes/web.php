<?php

use App\Http\Controllers\{
    ProductController,
    ReportsController,
    SaleController
};

use Illuminate\Support\Facades\Route;

Route::get('/', [ReportsController::class, 'index']);

Route::get('produtos', function () {
    return view('site.products');
});
Route::get('vendas', function () {
    return view('site.sales');
});

Route::resource('product', ProductController::class)->except('create', 'edit');
Route::resource('sale', SaleController::class)->except('create', 'edit');
