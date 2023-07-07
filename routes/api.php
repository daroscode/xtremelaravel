<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\InventoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for the Students API CRUD.
Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::get('students/{id}/edit', [StudentController::class, 'edit']);
Route::put('students/{id}/edit', [StudentController::class, 'update']);
Route::delete('students/{id}/delete', [StudentController::class, 'destroy']);

// Routes for the Inventory API CRUD.
Route::get('inventory', [InventoryController::class, 'index']);
Route::get('inventory/{id}', [InventoryController::class, 'show']);
Route::put('inventory/{id}/edit', [InventoryController::class, 'update']);
Route::delete('inventory/{id}/delete', [InventoryController::class, 'destroy']);
Route::post('inventory', [InventoryController::class, 'store']);
