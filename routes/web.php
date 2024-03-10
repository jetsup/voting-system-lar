<?php

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
    return view("index");
});

Route::get("dashboard", function () {
    return view("admin/dashboard");
});
// End Page Routes

// Authentication
Route::get("login", function () {
    return view("login");
});

Route::post("signin", function () {
});

Route::get("register", function () {
    return view("register");
})->middleware("auth");

Route::post("signup", function () { });
// End Authentication

// Data Requests
// End DataRequests