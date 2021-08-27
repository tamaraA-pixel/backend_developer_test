<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\request_statusController;

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


// Route::resource('/index', request_statusController::class);
Route::get('/index', [request_statusController::class, 'index']);
Route::post('/request', [request_statusController::class, 'show_requests']);
Route::post('/friend', [request_statusController::class, 'show_friends']);
Route::post('/create', [request_statusController::class, 'create']);
Route::put('/update/{reciever}', [request_statusController::class, 'update']);
Route::delete('/delete/{id}', [request_statusController::class, 'delete']);
