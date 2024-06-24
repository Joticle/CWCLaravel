<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
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

Route::name('api.')->group(function () {

    /*Login API's*/
    //Route::post('login', [AuthController::class, 'login'])->name('login');
    //Route::middleware("auth:api")->group(function (){
        /*Auth API's*/
        //Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        //Route::get('profile', [ApiController::class, 'profile'])->name('getProfile');
    //});
});



