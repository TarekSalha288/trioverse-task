<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReplayController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
     Route::post('/logout', [AuthController::class, 'logout']);
     Route::post('/verify', [AuthController::class, 'verify']);
     Route::middleware('verified')->group(function () {
        Route::prefix('tickets')->group(function () {
                Route::post('/', [TicketController::class, 'createTicket']);
                Route::get('/', [TicketController::class, 'getTickets']);
                Route::get('/{ticket}', [TicketController::class, 'getTicketById']);
        });
        Route::prefix('/replays')->group(function(){
               Route::post('/',[ReplayController::class,'createReplay']);
               Route::get('/',[ReplayController::class,'getReplays']);
               Route::get('/{replayId}',[ReplayController::class,'getReplayById']);
        });
    });

});
