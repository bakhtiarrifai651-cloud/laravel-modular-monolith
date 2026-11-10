<?php

use Illuminate\Support\Facades\Route;
use Modules\Books\Controllers\BookController;

Route::prefix('api/books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('/', [BookController::class, 'store']);
    Route::post('/{id}/borrow', [BookController::class, 'borrow']);
});