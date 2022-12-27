<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DichesController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => ['token_session_expired']], function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'upsert'])->name('category.upsert');
    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/diches', [DichesController::class, 'index'])->name('diches.index');
    Route::post('/diches', [DichesController::class, 'upsert'])->name('diches.upsert');
    Route::post('/diches/delete', [DichesController::class, 'delete'])->name('diches.delete');

    Route::get('/report', [ReportController::class, 'report'])->name('report.index');
});
