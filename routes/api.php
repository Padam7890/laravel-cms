<?php

use App\Http\Controllers\authController;
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
Route::post("/auth/login", [authController::class, "login"]);
Route::post("/auth/signup", [authController::class, "signup"]);


Route::get("/employee", [EmployeController::class, "index"])->name('employee');
Route::get("/employee/{id}", [EmployeController::class, "show"]);

Route::post('/employees', [EmployeController::class, 'store']);

Route::delete('/employees/{id}', [EmployeController::class,"destroy"]);


//Route::apiResource('post', EmployeController::class);

