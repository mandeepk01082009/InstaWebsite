<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();    
});

Route::get("data",[ApiController::class,'getData']);                              

Route::get("users",[ApiController::class,'getUsers']);                      

Route::get("show",[ApiController::class,'show']);  

Route::get("story",[ApiController::class,'getStory']);     

Route::post("store",[ApiController::class,'postComments']);    

Route::put("update",[ApiController::class,'update']);    

Route::get("search/{name}",[ApiController::class,'search']);

Route::delete("delete/{id}",[ApiController::class,'delete']);

Route::post("save",[ApiController::class,'testData']);

Route::post("upload",[ApiController::class,'upload']);  

Route::post("register",[ApiController::class,'register']);  

Route::post("login",[ApiController::class,'login']);  

Route::get("user",[ApiController::class,'user'])->middleware('auth:sanctum');  

Route::post("logout",[ApiController::class,'logout'])->middleware('auth:sanctum');

Route::group(["middleware" => 'api' , 'prefix'=> 'auth' ],function($router){
    Route::post('/register', [AuthController::class,'register']);    
    Route::post('/login', [AuthController::class,'login']);
    Route::get('/profile', [AuthController::class,'profile']);    
    Route::post('/logout', [AuthController::class,'logout']);      
});            
 

//Route::get('show', 'PostController@show');           

