<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\Constituencies;
use App\Models\Counties;
use App\Models\User;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function addCandidate(Request $request)
    {
        $formFields = $request->validate([
            // TODO: refactor input names to match database field_names
        ]);
        $userIDNumber = $request->input("id_number");
        $userID = User::where("id_number", "=", $userIDNumber)->first("id")["id"];
        $viePositionID = $request->input("position");
        $partyID = $request->input("party");
        $electionID = $request->input("election_id");

        // TODO: necessary?
        $affidavit = $request->file("affidavit");

        // check if the candidate already in this election candidate list
        $candidateRegistered = Candidates::where("user_id", "=", $userID)->where("election_id", "=", $electionID)->first();

        if ($candidateRegistered) {
            return back()->with("message", "Candidate already in added!");
        }

        // add the candidate, no need to check if is already in database, is not
        $candidate = Candidates::create(["user_id" => $userID, "vie_position_id" => $viePositionID, "party_id" => $partyID, "election_id" => $electionID]);

        if ($candidate) {
            return back()->with("message", "Candidate added successfully");
        } else {
            return back()->with("error", "Candidate creation failed");
        }
    }

    public function editCandidate(Request $request)
    {
        $userID = User::where("id_number", "=", $request->input("id_number"))->first("id");
        if ($userID) {
            $userID = $userID["id"];
            $candidate = Candidates::where("user_id", "=", $userID)
                ->join("users", "candidates.user_id", "=", "users.id")
                ->select(["candidates.*", "users.first_name", "users.last_name", "users.gender_id", "users.dp", "users.constituency_id", "users.id_number"])
                ->first();
            // dd($request->input("id_number"), $userID, $candidate);
            if ($candidate) {
                return view("admin/update-candidate", ["candidate" => $candidate]);
            } else {
                return back()->with("error", "No such candidate found!");
            }
        }
    }

    public function updateCandidate(Request $request)
    {
        $userID = User::where("id_number", "=", $request->input("id_number"))->first("id")["id"];
        $electionID = $request->input("election_id");
        $partyID = $request->input("party");
        $viePositionID = $request->input("position");
        $updated = Candidates::where("user_id", "=", $userID)->update(["election_id" => $electionID, "party_id" => $partyID, "vie_position_id" => $viePositionID]);

        // dd($request, $updated);

        if ($updated) {
            return back()->with("message", "Candidate updated successfully!");
        } else {
            return back()->with("error", "Candidate update failed");
        }
    }

    public function deleteCandidate(Request $request)
    {
        $userID = User::where("id_number", "=", $request->input("id_number"))->first("id")["id"];
        $deleted = Candidates::where("user_id", "=", $userID)->delete();
        if ($deleted) {
            return redirect("/edit-candidate")->with("success", "Candidate successfully deleted from the system");
        } else {
            return back()->with("error", "The candidate could not be deleted!");
        }
    }

    public function getCandidates(Request $request, $queryTypeID, $placeID)
    {
        if ($queryTypeID == 0) {
            // province
            $countiesIDs = Counties::where("province_id", "=", $placeID)->get("id")->pluck("id")->toArray();
            $constituenciesIDs = Constituencies::whereIn("county_id", $countiesIDs)->get("id")->pluck("id")->toArray();
            $usersInLocation = User::whereIn("constituency_id", $constituenciesIDs)->get("id");

            if ($usersInLocation) {
                $usersInLocation = $usersInLocation->pluck("id")->toArray();

                $candidates = Candidates::whereIn("user_id", $usersInLocation)->join("users", function ($join) {
                    $join->on("candidates.user_id", "=", "users.id");
                })->leftJoin("political_positions", function ($join) {
                    $join->on("candidates.vie_position_id", "=", "political_positions.id");
                })->leftJoin("political_parties", function ($join) {
                    $join->on("candidates.party_id", "=", "political_parties.id");
                })->leftJoin("elections", function ($join) {
                    $join->on("candidates.election_id", "=", "elections.id");
                })->leftJoin("constituencies", function ($join) {
                    $join->on("users.constituency_id", "=", "constituencies.id");
                })->leftJoin("counties", function ($join) {
                    $join->on("constituencies.county_id", "=", "counties.id");
                })->leftJoin("provinces", function ($join) {
                    $join->on("counties.province_id", "=", "provinces.id");
                })->get();
                // dd($usersInLocation, $candidates);
            }
        } else if ($queryTypeID == 1) {
            // county
            $constituenciesIDs = Constituencies::where("county_id", "=", $placeID)->get("id")->pluck("id")->toArray();
            $usersInLocation = User::whereIn("constituency_id", $constituenciesIDs)->get("id");

            if ($usersInLocation) {
                $usersInLocation = $usersInLocation->pluck("id")->toArray();

                $candidates = Candidates::whereIn("user_id", $usersInLocation)->join("users", function ($join) {
                    $join->on("candidates.user_id", "=", "users.id");
                })->leftJoin("political_positions", function ($join) {
                    $join->on("candidates.vie_position_id", "=", "political_positions.id");
                })->leftJoin("political_parties", function ($join) {
                    $join->on("candidates.party_id", "=", "political_parties.id");
                })->leftJoin("elections", function ($join) {
                    $join->on("candidates.election_id", "=", "elections.id");
                })->leftJoin("constituencies", function ($join) {
                    $join->on("users.constituency_id", "=", "constituencies.id");
                })->leftJoin("counties", function ($join) {
                    $join->on("constituencies.county_id", "=", "counties.id");
                })->leftJoin("provinces", function ($join) {
                    $join->on("counties.province_id", "=", "provinces.id");
                })->get();
            }
        } else if ($queryTypeID == 2) {
            // constituency
            $usersInLocation = User::where("constituency_id", "=", $placeID)->get("id");

            if ($usersInLocation) {
                $usersInLocation = $usersInLocation->pluck("id")->toArray();

                $candidates = Candidates::whereIn("user_id", $usersInLocation)->join("users", function ($join) {
                    $join->on("candidates.user_id", "=", "users.id");
                })->leftJoin("political_positions", function ($join) {
                    $join->on("candidates.vie_position_id", "=", "political_positions.id");
                })->leftJoin("political_parties", function ($join) {
                    $join->on("candidates.party_id", "=", "political_parties.id");
                })->leftJoin("elections", function ($join) {
                    $join->on("candidates.election_id", "=", "elections.id");
                })->leftJoin("constituencies", function ($join) {
                    $join->on("users.constituency_id", "=", "constituencies.id");
                })->leftJoin("counties", function ($join) {
                    $join->on("constituencies.county_id", "=", "counties.id");
                })->leftJoin("provinces", function ($join) {
                    $join->on("counties.province_id", "=", "provinces.id");
                })->get();
            }
        }
        return response()->json(["candidates" => $candidates]);
    }
}
