<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::post('logout', [AuthController::class, 'login'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->prefix('todo')->group(function () {
    Route::get('', [TodoListController::class, 'index']);
    Route::post('store', [TodoListController::class, 'store']);
    Route::post('update/{todoList}', [TodoListController::class, 'update']);
    Route::delete('delete/{todoList}', [TodoListController::class, 'destroy']);
});
