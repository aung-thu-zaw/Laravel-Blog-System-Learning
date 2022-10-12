<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Blog Routes
Route::get('/', [BlogController::class,"index"]);

Route::get("/blogs/{blog:slug}", [BlogController::class,"show"]);

Route::post("/blogs/{blog:slug}/subscription", [BlogController::class,"subscriptionHandler"]);

// Comment Route
Route::post("/blogs/{blog:slug}/comments", [CommentController::class,"store"]);

// Authentication Routes
Route::get("/register", [AuthController::class,"create"])->middleware("guest");

Route::post("/register", [AuthController::class,"store"])->middleware("guest");

Route::get("/login", [AuthController::class,"login"])->middleware("guest");

Route::post("/login", [AuthController::class,"user_login"])->middleware("guest");

Route::post("/logout", [AuthController::class,"logout"])->middleware("auth");


// Admin Routes
// Route::get("/admin/blogs", [AdminBlogController::class,"index"])->middleware("can:admin");

// Route::get("/admin/blogs/create", [AdminBlogController::class,"create"])->middleware("can:admin");

// Route::post("/admin/blogs/store", [AdminBlogController::class,"store"])->middleware("can:admin");

// Route::get("/admin/blogs/{blog:slug}/edit", [AdminBlogController::class,"edit"])->middleware("can:admin");

// Route::patch("/admin/blogs/{blog:slug}/update", [AdminBlogController::class,"update"])->middleware("can:admin");

// Route::delete("/admin/blogs/{blog:slug}/delete", [AdminBlogController::class,"destory"])->middleware("can:admin");



Route::middleware("can:admin")->group(function () {
    Route::get("/admin/blogs", [AdminBlogController::class,"index"]);

    Route::get("/admin/blogs/create", [AdminBlogController::class,"create"]);

    Route::post("/admin/blogs/store", [AdminBlogController::class,"store"]);

    Route::get("/admin/blogs/{blog:slug}/edit", [AdminBlogController::class,"edit"]);

    Route::patch("/admin/blogs/{blog:slug}/update", [AdminBlogController::class,"update"]);

    Route::delete("/admin/blogs/{blog:slug}/delete", [AdminBlogController::class,"destory"]);
});

// Route::get("/categories/{category:categorySlug}", function (Category $category) {
//     return view("blogs", [
//         "blogs"=>$category->blogs, //"blogs"=>$user->blogs->load()
//         "categories"=>Category::all(),
//         "currentCategory"=>$category
//     ]);
// });


// Route::get("/users/{user:username}", function (User $user) {
//     return view("blogs", [
//         "blogs"=>$user->blogs //"blogs"=>$user->blogs->load()
//     ]);
// });
