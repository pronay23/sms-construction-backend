<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\EmployeeAuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectInventoryController;
use App\Http\Controllers\Api\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('homes', HomeController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('project-inventories', ProjectInventoryController::class)
    ->only(['index', 'store']);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('inventories', InventoryController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('currencies', CurrencyController::class);
Route::apiResource('vendors', VendorController::class);
Route::apiResource('expenses', ExpenseController::class);
Route::apiResource('employees', EmployeeController::class);
Route::post('/employee/login', [EmployeeAuthController::class, 'login']);
Route::post('/employee/logout', [EmployeeAuthController::class, 'logout']);
