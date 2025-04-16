<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\PasswordResetApiController;
use Illuminate\Http\Request;
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
// Route::get('/users/{id}', [AuthController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/users', [AuthController::class, 'index']);

Route::post('/forgot-password', [PasswordResetApiController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PasswordResetApiController::class, 'reset']);
Route::post('/send-otp', [PasswordResetApiController::class, 'sendOtp']);
Route::post('/reset-password/otp', [PasswordResetApiController::class, 'resetWithOtp']);




Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/update/{id}', [AuthController::class, 'update']);
    Route::get('/users', [AuthController::class, 'index']);
});
