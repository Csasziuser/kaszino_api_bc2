<?php

use App\Http\Controllers\DealerController;
use App\Http\Controllers\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tables', [TableController::class, 'index']);
Route::post('/tables',[TableController::class,'store']);
Route::put('/tables/{id}',[TableController::class, 'update']);

Route::get('/dealers', [DealerController::class, "index"]);
Route::post('/dealers', [DealerController::class, "store"]);
Route::put('/dealers/{id}', [DealerController::class, "update"]);
Route::delete('/dealers/{id}', [DealerController::class, "destroy"]);