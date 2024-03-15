<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoterController;
use Illuminate\Http\Request;
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
})->name("home");

/**********************ADMIN**********************/
// Admin voter
Route::get("add-voter", function () {
    return view("admin/add-voter");
})->middleware("auth");

Route::get("edit-voter", function () {
    return view("admin/edit-voter");
})->middleware("auth");

Route::post("edit-voter", [VoterController::class, "editVoter"])->middleware(("auth"));

Route::post("update-voter", [UserController::class, "update"]);

Route::get("view-voter", function () {
    return view("admin/view-voter");
})->middleware("auth");
// End Admin voter

// Admin candidate
Route::get("add-candidate", function () {
    return view("admin/add-candidate");
})->middleware("auth");

Route::get("edit-candidate", function () {
    return view("admin/edit-candidate");
})->middleware("auth");

Route::get("view-candidate", function () {
    if (auth()->user()->user_type_id == 1) {
        return view("admin/view-candidate");
    } else {
        return view("voter/view-candidate");
    }
})->middleware("auth");
// End Admin candidate

// Admin election
Route::get("generate-election", function () {
    return view("admin/generate-election");
})->middleware("auth");

Route::get("modify-election", function () {
    return view("admin/modify-election");
})->middleware("auth");

Route::get("complete-election", function () {
    return view("admin/complete-election");
})->middleware("auth");
// End Admin election
Route::get("voting", function () {
    return view("admin/voting");
})->middleware("auth");

// Admin voting
Route::get("voting", function () {
    return view("admin/voting");
})->middleware("auth");
// End Admin candidate

// Results and Reports
Route::get("generate-result", function () {
    return view("admin/generate-result");
})->middleware("auth");

Route::get("view-result", function () {
    if (auth()->user()->user_type_id == 1) {
        return view("admin/view-result");
    } else {
        return view("voter/view-result");
    }
})->middleware("auth");

Route::get("generate-report", function () {
    return view("admin/generate-report");
})->middleware("auth");

Route::get("view-report", function () {
    if (auth()->user()->user_type_id == 1) {
        return view("admin/view-report");
    } else {
        return view("voter/view-report");
    }
})->middleware("auth");
// End Results and Reports

// Admin complains
Route::get("view-complain", function () {
    return view("admin/view-complain");
})->middleware("auth");
Route::get("reply-complain", function () {
    return view("admin/reply-complain");
})->middleware("auth");
// End Admin complain
/**********************END ADMIN**********************/

/**********************VOTER**********************/
// Voting process
Route::get("voting-process", function () {
    return view("voter/voting-process");
})->middleware("auth");
// End Voting process

// Voter profile
Route::get("profile", [SystemUserController::class, "get_profile"])->middleware("auth");
// End Voter profile

// Voter election
Route::get("election", function () {
    return view("voter/election");
})->middleware("auth");
// End Voter election

// Voter complain
Route::get("complain", function () {
    return view("voter/complain");
})->middleware("auth");
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

Route::post("add_voter", [UserController::class, "store"])->middleware("auth");
// End Authentication

/************************DATA FETCH API(JSON)*****************************/
// Data Requests
Route::get("data/get_provinces", [LocationController::class, "get_provinces"]);
Route::get("data/get_counties/{provinceID}", [LocationController::class, "get_counties"]);
Route::get("data/get_constituencies/{countyID}", [LocationController::class, "get_constituencies"]);

Route::get("data/view_voters", [SystemUserController::class, "getVotersByLoc"])->middleware("auth");
// End DataRequests