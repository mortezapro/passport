<?php

use App\Http\Controllers\Api\autController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('register',[autController::class,'register'])->name("register");
Route::post('login',[autController::class,'login'])->name("login");
Route::get('users',[autController::class,'users'])->middleware('auth:api');
