<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BookTypeController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ReportController;
use App\Models\Report;
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
Route::prefix('/auth')->group(function () {
    Route::post('/login',[ AuthController::class, 'login']);
    Route::post('/register',[ AuthController::class, 'register']);
});

Route::middleware('auth:sanctum', 'restrictRole:admin')->prefix('/user')->group(function () {
    Route::get('/',[ UserController::class, 'get']);
    Route::post('/',[ UserController::class, 'create']);
    Route::delete('/{id}',[ UserController::class, 'delete']);
    Route::get('/{id}',[ UserController::class, 'getById']);
    Route::put('/{id}',[ UserController::class, 'update']);
});

Route::middleware('auth:sanctum')->prefix('/book-type')->group(function () {
    Route::get('/',[ BookTypeController::class, 'get']);
    Route::post('/',[ BookTypeController::class, 'create'])->middleware('restrictRole:admin');
    Route::delete('/{id}',[ BookTypeController::class, 'delete'])->middleware('restrictRole:admin');
    Route::get('/{id}',[ BookTypeController::class, 'getById']);
    Route::put('/{id}',[ BookTypeController::class, 'update'])->middleware('restrictRole:admin');
});

Route::middleware('auth:sanctum')->prefix('/book')->group(function () {
    Route::get('/',[ BookController::class, 'get']);
    Route::post('/',[ BookController::class, 'create'])->middleware('restrictRole:admin');
    Route::delete('/{id}',[ BookController::class, 'delete'])->middleware('restrictRole:admin');
    Route::get('/{id}',[ BookController::class, 'getById']);
    Route::put('/{id}',[ BookController::class, 'update'])->middleware('restrictRole:admin');
});

Route::middleware('auth:sanctum')->prefix('/transaction')->group(function () {
    Route::get('/',[ TransactionController::class, 'get']);
    Route::get('/detail',[ TransactionController::class, 'get']);
    Route::put('/{id}',[ TransactionController::class, 'update']);
    Route::post('/',[ TransactionController::class, 'create']);
    Route::delete('/detail/{id}',[ TransactionController::class, 'delete']);
});

Route::middleware('auth:sanctum')->prefix('/report')->group(function () {
    Route::get('/',[ ReportController::class, 'get']);
    Route::get('/count',[ ReportController::class, 'getCount']);
    Route::get('/book-favorite',[ ReportController::class, 'getBookFav']);
});
