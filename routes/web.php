<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes    
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {   
//     return view('welcome');  
// }); 
// Route::get('/', function () {
//     return view('layouts.app');      
// });  


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{user}', [App\Http\Controllers\HomeController::class, 'index'])->name('home.show');  


Route::get('/p/create', [App\Http\Controllers\PostController::class, 'create']);
Route::post('/p', [App\Http\Controllers\PostController::class, 'store']);
Route::get('/p/{post}', [App\Http\Controllers\PostController::class, 'show']);
Route::get('/editpost/{id}', [App\Http\Controllers\PostController::class, 'edit']);
Route::patch('/updatepost/{id}',[App\Http\Controllers\PostController::class, 'update']);
Route::get('deletepost/{id}',[App\Http\Controllers\PostController::class, 'delete']);

//Comment System 
Route::post('comments',[App\Http\Controllers\CommentController::class, 'store']);
Route::get('delete-comment/{id}',[App\Http\Controllers\CommentController::class, 'destroy']);


//like system
Route::post('/like', [App\Http\Controllers\PostController::class, 'postLike'])->name('like');
Route::post('/like', [App\Http\Controllers\HomeController::class, 'likePost'])->name('like'); 

//follow unfollow
Route::get('user/{following_id}/follow',[App\Http\Controllers\PostController::class, 'follow'])->name('follow');  

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');     
