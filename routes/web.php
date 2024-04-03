<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ComplainsController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PoliticalPartiesController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoterController;
use App\Models\Complains;
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

Route::get("data/view_voters/{queryTypeID}/{placeID}", [VoterController::class, "getVoters"])->middleware("auth");
// End Admin voter

// Admin candidate
Route::get("search-voter/{idNumber}", [VoterController::class, "searchVoter"])->middleware("auth");

Route::get("add-candidate", function () {
    return view("admin/add-candidate", ["message" => "", "error" => ""]);
})->middleware("auth");

Route::post("add-candidate", [CandidateController::class, "addCandidate"])->middleware("auth");

Route::get("edit-candidate", function () {
    return view("admin/edit-candidate");
})->middleware("auth");

Route::post("edit-candidate", [CandidateController::class, "editCandidate"])->middleware("auth");

Route::post("update-candidate", [CandidateController::class, "updateCandidate"])->middleware("auth");

Route::get("delete-candidate", [CandidateController::class, "deleteCandidate"])->middleware("auth");

Route::get("view-candidate", [CandidateController::class, "viewCandidates"])->middleware("auth");

Route::get("data/view-candidates/{queryTypeID}/{placeID}", [CandidateController::class, "getCandidates"])->middleware("auth");
// End Admin candidate

// Admin election
Route::get("generate-election", function () {
    return view("admin/generate-election");
})->middleware("auth");

Route::post("generate-election", [ElectionController::class, "generateElection"])->middleware("auth");

Route::get("modify-election", [ElectionController::class, "modifyElection"])->middleware("auth");
Route::post("modify-election", [ElectionController::class, "modifyElection"])->middleware("auth");

Route::get("complete-election", function () {
    return view("admin/complete-election");
})->middleware("auth");

Route::get("data/get-election-types", [ElectionController::class, "getElectionTypes"])->middleware("auth");
Route::get("/data/get-elections/{electionTypeID}", [ElectionController::class, "getElections"])->middleware("auth");
Route::get("/data/get-election-details/{electionID}", [ElectionController::class, "getElectionDetails"])->middleware("auth");
// End Admin election

// Admin voting
Route::get("voting", function () {
    return view("admin/voting");
})->middleware("auth");
// End Admin candidate

// Results and Reports
Route::get("generate-result", function () {
    return view("admin/generate-result");
})->middleware("auth");

Route::get("view-result", [ElectionController::class, "viewResults"]/*function () {
    if (auth()->user()->user_type_id == 1) {
        return view("admin/view-result");
    } else {
        return view("voter/view-result");
    }
}*/)->middleware("auth");

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
Route::get("view-complain", [ComplainsController::class, "getComplains"])->middleware("auth");
Route::post("/complain/resolve", [ComplainsController::class, "resolveComplain"])->middleware("auth");
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
Route::get("election", [ElectionController::class, "voting"])->middleware("auth");
Route::post("election/vote", [ElectionController::class, "castVote"])->middleware("auth");
// End Voter election

// Voter complain
Route::get("complain", [ComplainsController::class, "complain"])->middleware("auth");
Route::post("complain", [ComplainsController::class, "complain"])->middleware("auth");
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

Route::get("create-party", [PoliticalPartiesController::class, "create"]);
Route::post("create-party", [PoliticalPartiesController::class, "create"]);
// End Authentication

/************************DATA FETCH API(JSON)*****************************/
// Data Requests
Route::get("data/get-provinces", [LocationController::class, "getProvinces"]);
Route::get("data/get_counties/{provinceID}", [LocationController::class, "getCounties"]);
Route::get("data/get_constituencies/{countyID}", [LocationController::class, "getConstituencies"]);
Route::get("data/get-places/{queryFor}/{electionID}", [LocationController::class, "getPlaces"]);

Route::get("data/get-parties", [ElectionController::class, "getParties"])->middleware("auth");
Route::get("data/get-positions", [ElectionController::class, "getPositions"])->middleware("auth");
Route::get("data/get-positions/{userIDNumber}", [ElectionController::class, "getRelevantPositions"])->middleware("auth");
Route::get("data/get-party-logo/{partyID}", [ElectionController::class, "getPartyLogo"])->middleware("auth");
Route::get("data/election-statuses", [ElectionController::class, "getElectionStatuses"])->middleware("auth");

Route::get("data/election-results", [ElectionController::class, "generateElectionResults"])->middleware("auth");

Route::get("data/get-candidates/{queryFor}/{placeID}", [CandidateController::class, "getCandidatesByLocation"])->middleware("auth");
// End DataRequests