<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Page Routes
Route::get("/", function () {
    if (auth()->user()) {
        if (auth()->user()->user_type_id = 1) {
            return view("admin/dashboard");
        } else {
            return view("voter/dashboard");
        }
    }
    // this will be a login screen
    return view("index");
});

// Admin voter
Route::get("add-voter", function () {
    return view("admin/add-voter");
});

Route::get("edit-voter", function () {
    return view("admin/edit-voter");
});

Route::get("view-voter", function () {
    return view("admin/view-voter");
});
// End Admin voter
Route::get("add-candidate", function () {
    return view("admin/add-candidate");
});
Route::get("edit-candidate", function () {
    return view("admin/edit-candidate");
});
Route::get("view-candidate", function () {
    return view("admin/view-candidate");
});
// Admin candidate
Route::get("generate-election", function () {
    return view("admin/generate-election");
});

Route::get("modify-election", function () {
    return view("admin/modify-election");
});

Route::get("complete-election", function () {
    return view("admin/complete-election");
});
// Admin election

// End Admin election

// End Admin candidadte
// End Page Routes

// Authentication
Route::get("login", [UserController::class, "login"]);

Route::post("signin", [UserController::class, "signin"]);

Route::get("logout", [UserController::class, "logout"]);

Route::get("register", function () {
    return view("register");
})->middleware("auth");

Route::post("signup", function () {
});
// End Authentication

// Data Requests
// End DataRequests