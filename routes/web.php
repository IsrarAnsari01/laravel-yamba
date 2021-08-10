<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\VideoUploadController;
use App\Http\Controllers\VideocetagoryController;
use App\Http\Controllers\VideocommentController;

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

Auth::routes();

//Posts Routes
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post', [PostController::class, 'show'])->name('post');
Route::get('/addBlog', [PostController::class, 'create'])->name('addBlog');
Route::post("submitPost/{id}", [PostController::class, 'store']);
Route::get("deleteBlog/{id}", [PostController::class, 'destroy'])->name("Post.delete");
Route::post("filterPost", [PostController::class, 'filterPost'])->name("Post.find");
Route::post("TagPosts", [PostController::class, 'filterPostThroughTags'])->name("Post.findTags");
Route::get("fullPost/{id}", [PostController::class, 'singlePost'])->name("Post.full");
Route::get("updatePost/{id}", [PostController::class, 'edit'])->name("Post.edit");
Route::get("saveUpdatedData/{id}&{auth_id}", [PostController::class, 'singlePost'])->name("Post.update");

// User / Author Routes
Route::get("signPage", [AuthorController::class, 'create']);
Route::post("addUser", [AuthorController::class, 'store']);
Route::get("loginPage", [AuthorController::class, 'index']);
Route::post("loginUser", [AuthorController::class, 'loginUser']);
Route::get("authorDashboard/{id}", [AuthorController::class, 'show']);
Route::get("updateInformation/{id}", [AuthorController::class, 'edit'])->name("Author.updatePage");
Route::post("updateUserInformation/{id}", [AuthorController::class, 'update'])->name("Author.update");
Route::get("deleteUser/{id}", [AuthorController::class, 'destroy'])->name("Author.delete");
Route::get("logoutUser", [AuthorController::class, 'logoutUser'])->name("Author.logout");
Route::get("updateUserVideoCategory/{id}&{postId}", [AuthorController::class, 'updateUserVideoCategory'])->name("Author.updateCatId");
Route::get("subcribedCategory/{cat_id}&{id}&{video_id}", [AuthorController::class, 'subcribeCategory'])->name("Author.subscribeCat");
Route::get("unsubscribeCategory/{cat_id}&{id}&{video_id}", [AuthorController::class, 'unSubcribeCategory'])->name("Author.unSubscribeCat");


// Category Routes
Route::get("categoryPage", [CategoryController::class, "index"]);
Route::post("addCategory", [CategoryController::class, "store"])->name("Category.add");
Route::get("allCategories", [CategoryController::class, "show"]);
Route::get("deleteCat/{id}", [CategoryController::class, "destroy"]);

// Video Category Routes
Route::get("videoCategoryPage", [VideocetagoryController::class, "index"])->name("VideoCategory.show");
Route::post("addVideoCategory", [VideocetagoryController::class, "store"])->name("VideoCategory.add");
Route::get("allVideoCategories", [VideocetagoryController::class, "show"]);
Route::get("deleteVidCat/{id}", [VideocetagoryController::class, "destroy"]);

//Tags Routes
Route::get("tagPage", [TagController::class, "index"]);
Route::post("addTags", [TagController::class, "store"])->name("Tag.add");
Route::get("allTags", [TagController::class, "show"]);
Route::get("deleteTag/{id}", [TagController::class, "destroy"]);

//Comments Route
Route::post("addComment/{id}&{post_id}", [CommentController::class, "store"])->name("Comment.save");

// Video Routes
Route::get("uploadVideo", [VideoUploadController::class, "create"])->name("videoUpload.upload");
Route::post("submitVideo/{id}", [VideoUploadController::class, 'store']);
Route::get("allVideos", [VideoUploadController::class, "index"]);
Route::get("SingleVideo/{id}", [VideoUploadController::class, "show"])->name("videoUpload.single");
Route::get("updateVideoViews/{id}", [VideoUploadController::class, "updateViews"])->name("videoUpload.updateView");
Route::get("viewSingleVideo/{id}&{cat_id}", [VideoUploadController::class, "singleVideo"])->name("videoUpload.singleVideo");
Route::get("deleteVideo/{id}", [VideoUploadController::class, "destroy"])->name("videoUpload.delete");
//Video Comments
Route::post("addVideoComment/{id}&{video_id}&{cat_id}", [VideocommentController::class, "store"])->name("VideoComment.save");

