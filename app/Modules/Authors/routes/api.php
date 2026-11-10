<?php

use Illuminate\Support\Facades\Route;
use Modules\Authors\Controllers\AuthorController;

Route::prefix('api/authors')->group(function () {
    Route::get('/', [AuthorController::class, 'index']);
    Route::post('/', [AuthorController::class, 'store']);
    Route::delete('/{id}', [AuthorController::class, 'destroy']);
});