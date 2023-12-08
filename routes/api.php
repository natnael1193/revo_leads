<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//updateCustomer
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('/customers', \App\Http\Controllers\Admin\CustomerController::class);
    Route::resource('/information_source', \App\Http\Controllers\Admin\InformationSourceController::class);
    Route::resource('/property_type', \App\Http\Controllers\Admin\PropertyTypeController::class);
    Route::post('/update_customer/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'updateCustomer']);
});



Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return response("success");
});

Route::get('/config_cache', function () {
    Artisan::call('config:cache');
    return response("success");
});

Route::get('/cache_clear', function () {
    Artisan::call('cache:clear');
    return response("success");
});

Route::get('/optimize', function () {
    Artisan::call('optimize');
    return response("success");
});