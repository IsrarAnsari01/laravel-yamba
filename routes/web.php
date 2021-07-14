<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthorController;


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
// Route::get('/', [PostController::class, 'index']);

Auth::routes();

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post', [PostController::class, 'postPage'])->name('post');
Route::get('/addBlog', [PostController::class, 'create'])->name('addBlog');
Route::post("submitPost/{id}", [PostController::class, 'store']);

// User / Author Routes
Route::get("signPage", [AuthorController::class, 'create']);
Route::post("addUser", [AuthorController::class, 'store']);
Route::get("loginPage", [AuthorController::class, 'index']);
Route::post("loginUser", [AuthorController::class, 'loginUser']);
Route::get("authorDashboard/{id}", [AuthorController::class, 'show']);
Route::get("updateInformation/{id}", [AuthorController::class, 'edit']);
Route::post("updateUserInformation/{id}", [AuthorController::class, 'update'])->name("Author.update");
Route::get("deleteUser/{id}", [AuthorController::class, 'destroy']);
