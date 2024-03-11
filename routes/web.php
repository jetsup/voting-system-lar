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
        if (auth()->user()->user_type_id == 1) {
            return view("admin/dashboard");
        } else {
            return view("voter/dashboard");
        }
    }
    // this will be a login screen
    return view("index");
});

/**********************ADMIN**********************/
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

// Admin candidate
Route::get("add-candidate", function () {
    return view("admin/add-candidate");
});
Route::get("edit-candidate", function () {
    return view("admin/edit-candidate");
});
Route::get("view-candidate", function () {
    if (auth()->user()->user_type_id == 1) {
        return view("admin/view-candidate");
    } else {
        return view("voter/view-candidate");
    }
});
// End Admin candidate

// Admin election
Route::get("generate-election", function () {
    return view("admin/generate-election");
});

Route::get("modify-election", function () {
    return view("admin/modify-election");
});

Route::get("complete-election", function () {
    return view("admin/complete-election");
});
// End Admin election
Route::get("voting", function () {
    return view("admin/voting");
});

// Admin voting
Route::get("voting", function () {
    return view("admin/voting");
});
// End Admin candidadte

// Results and Reports
Route::get("generate-result", function () {
    return view("admin/generate-result");
});

Route::get("view-result", function () {
    if (auth()->user()->user_type_id == 1) {
        return view("admin/view-result");
    } else {
        return view("voter/view-result");
    }
});

Route::get("generate-report", function () {
    return view("admin/generate-report");
});

Route::get("view-report", function () {
    if (auth()->user()->user_type_id == 1) {
        return view("admin/view-report");
    } else {
        return view("voter/view-report");
    }
});
// End Results and Reports

// Admin complains
Route::get("view-complain", function () {
    return view("admin/view-complain");
});
Route::get("reply-complain", function () {
    return view("admin/reply-complain");
});
// End Admin complain
/**********************END ADMIN**********************/

/**********************VOTER**********************/
// Voting process
Route::get("voting-process", function () {
    return view("voter/voting-process");
});
// End Voting process

// Voter profile
Route::get("profile", function () {
    return view("voter/profile");
});
// End Voter profile

// Voter election
Route::get("election", function () {
    return view("voter/election");
});
// End Voter election

// Voter complain
Route::get("complain", function () {
    return view("voter/complain");
});
// End Voter complain
/********************END VOTER********************/
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