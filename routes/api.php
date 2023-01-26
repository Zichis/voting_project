<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShareholderController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VotingItemController;
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

Route::post('/login', [LoginController::class, 'login']);

// Admin routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/shareholders', [ShareholderController::class, 'store']);
    Route::post('/voting-items', [VotingItemController::class, 'store']);
    Route::get('/votes', [VoteController::class, 'index']);
});

Route::middleware('auth:sanctum')->get('/voting-items', [VotingItemController::class, 'index']);
Route::middleware('auth:sanctum')->post('/votes', [VoteController::class, 'store']);