<?php

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController; 



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
Route::delete('books/{id}', [BookController::class, 'destroy']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('books', BookController::class);


Route::middleware('auth:api')->group(function () { 
    Route::post('/logout', [AuthController::class, 'logout']); 
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('/users', function (){
    return response()->json(User::all());
});
