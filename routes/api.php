<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', [ProductController::class, 'index'])
    ->name('api.products.index');
