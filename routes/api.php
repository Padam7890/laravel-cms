<?php

use App\Http\Controllers\EmployeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/employee", [EmployeController::class, "index"]);
Route::get("/employee/{id}", [EmployeController::class, "show"]);

Route::post('/employees', [EmployeController::class, 'store']);

Route::delete('/employees/{id}', [EmployeController::class,"destroy"]);

