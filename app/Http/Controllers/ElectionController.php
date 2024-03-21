<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\Constituencies;
use App\Models\Counties;
use App\Models\Elections;
use App\Models\ElectionStatus;
use App\Models\ElectionTypes;
use App\Models\PoliticalParties;
use App\Models\PoliticalPositions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function getElectionTypes()
    {
        $electionTypes = ElectionTypes::orderBy("id")->get(["id", "election_type"]);
        return response()->json(["electionTypes" => $electionTypes]);
    }

    public function generateElection(Request $request)
    {
        $electionType = $request->input("election-type");
        $startDate = $request->input("start-date");
        $endDate = $request->input("end-date");

        $startDate = Carbon::parse($startDate)->format("Y-m-d H:i:s");
        $endDate = Carbon::parse($endDate)->format("Y-m-d H:i:s");

        if ($electionType == 1) {
            $election = Elections::create(
                [
                    "election_type" => $electionType,
                    "start_date" => $startDate,
                    "end_date" => $endDate,
                    "election_status" => 1/*upcoming*/
                ]
            );
        } else {
            $countyID = $request->input("county");
            $constituencyID = $request->input("constituency");

            $election = Elections::create(
                [
                    "election_type" => $electionType,
                    "start_date" => $startDate,
                    "end_date" => $endDate,
                    "election_status" => 1/*upcoming*/,
                    "county_id" => $countyID,
                    "constituency_id" => $constituencyID
                ]
            );
        }
        // dd($request, $election);
        if ($election) {
            return back()->with("message", "Election was generated successfully.");
        } else {
            return back()->with("error", "Election generation failed!");
        }
    }

    public function modifyElection(Request $request)
    {
        if ($request->method() == "POST") {
            $electionType = $request->input("election-type");
            $electionStatus = $request->input("election-status");
            $electionID = $request->input("election-id");
            $startDate = $request->input("start-date");
            $endDate = $request->input("end-date");

            $startDate = Carbon::parse($startDate)->format("Y-m-d H:i:s");
            $endDate = Carbon::parse($endDate)->format("Y-m-d H:i:s");



            if ($electionType == 1) {
                $election = Elections::where("id", "=", $electionID)->update(
                    [
                        "election_type" => $electionType,
                        "start_date" => $startDate,
                        "end_date" => $endDate,
                        "election_status" => $electionStatus,
                    ]
                );
            } else {
                $countyID = $request->input("county");
                $constituencyID = $request->input("constituency");

                $election = Elections::where("id", "=", $electionID)->update(
                    [
                        "election_type" => $electionType,
                        "start_date" => $startDate,
                        "end_date" => $endDate,
                        "election_status" => $electionStatus,
                        "county_id" => $countyID,
                        "constituency_id" => $constituencyID
                    ]
                );
            }
            // dd($request, $election);
            if ($election) {
                return back()->with("message", "Election was generated successfully.");
            } else {
                return back()->with("error", "Election generation failed!");
            }
        } else if ($request->method() == "GET") {
            $upcomingElections = Elections::whereIn("election_status", [1, 2, 3]/*upcoming|ongoing|postponed*/)->get();
            return view("admin/modify-election", ["elections" => $upcomingElections]);
        }
    }

    public function getElections(Request $request, $electionStatusID)
    {
        if ($electionStatusID == 1) { // upcoming
            $todayDate = Carbon::parse(Carbon::now())->format("Y-m-d H:i:s");

            $elections = Elections::where("start_date", ">", $todayDate)->orderBy("elections.start_date", "desc")->where("election_status", "=", $electionStatusID)
                ->join("election_types", "elections.election_type", "=", "election_types.id")
                ->get(["elections.*", "election_types.election_type AS type"]);
            // dd($todayDate, $elections);
        } else if ($electionStatusID == 2) { // ongoing
        } else if ($electionStatusID == 3) { // postponed
        }

        // dd($todayDate, $elections);
        return response()->json(["elections" => $elections]);
    }

    public function getElectionDetails(Request $request, $electionID)
    {
        $electionTypes = ElectionTypes::orderBy("id")->get(["id", "election_type"]);
        $election = Elections::where("elections.id", "=", $electionID)
            ->join("election_types", "elections.election_type", "=", "election_types.id")
            ->get(["elections.*", "election_types.election_type AS type"])->first();

        return response()->json(["election" => $election, "electionTypes" => $electionTypes]);
    }

    public function getParties(Request $request)
    {
        $parties = PoliticalParties::orderBy("id")->get(["id", "party_leader", "party", "party_image"]);
        return response()->json(["parties" => $parties]);
    }

    public function getPositions()
    {
        $positions = PoliticalPositions::orderBy("id")->get(["id", "position"]);
        return response()->json(["positions" => $positions]);
    }

    public function getRelevantPositions(Request $request, $userIDNumber)
    {
        $userGender = User::where("id_number", $userIDNumber)->first("gender_id")->toArray()["gender_id"];
        if ($userGender == 1/*MALE*/) {
            $positions = PoliticalPositions::orderBy("id")->get(["id", "position"]);
            unset($positions[3]); // remove WomenRepresentative from positions options
        } else {
            $positions = PoliticalPositions::orderBy("id")->get(["id", "position"]);
        }
        return response()->json(["positions" => $positions]);
    }

    public function getPartyLogo(Request $request, $partyID)
    {
        $logo = PoliticalParties::where("id", "=", $partyID)->first("party_image");
        return response()->json(["logo" => $logo]);
    }

    public function getElectionStatuses()
    {
        $statuses = ElectionStatus::orderBy("id")->get(["id", "election_status"]);
        return response()->json(["statuses" => $statuses]);
    }

    public function generateElectionResults(Request $request)
    {
        dd($request);
    }

    public function voting()
    {
        $userConstituency = Constituencies::where("id", "=", auth()->user()->constituency_id)->first();
        // $userCounty = Counties::where("id", "=", $userConstituency->county_id)->first();
        $constituenciesInCounty = Constituencies::where("county_id", $userConstituency->county_id)->get(["id", "constituency", "county_id"])->pluck("id")->toArray();
        // no filters
        $presidents = Candidates::where("vie_position_id", "=", 1)->join("users", function ($join) {
            $join->on("candidates.user_id", "=", "users.id");
        })->join("political_parties AS parties", function ($join) {
            $join->on("candidates.party_id", "=", "parties.id");
        })->select([
            "candidates.id", "candidates.vie_position_id", "candidates.election_id",
            "candidates.user_id", "users.first_name", "users.last_name", "users.dp",
            "parties.party", "parties.party_image"
        ])->orderBy("candidates.id")->get();

        // be from same county as voter
        $governors = Candidates::where("vie_position_id", "=", 2)->join("users", function ($join) {
            $join->on("candidates.user_id", "=", "users.id");
        })->whereIn("users.constituency_id", $constituenciesInCounty)
            ->join("political_parties AS parties", function ($join) {
                $join->on("candidates.party_id", "=", "parties.id");
            })->select([
                "candidates.id", "candidates.vie_position_id", "candidates.election_id",
                "candidates.user_id", "users.first_name", "users.last_name", "users.dp",
                "parties.party", "parties.party_image"
            ])->orderBy("candidates.id")->get();

        $senators = Candidates::where("vie_position_id", "=", 3)->join("users", function ($join) {
            $join->on("candidates.user_id", "=", "users.id");
        })->whereIn("users.constituency_id", $constituenciesInCounty)
            ->join("political_parties AS parties", function ($join) {
                $join->on("candidates.party_id", "=", "parties.id");
            })->select([
                "candidates.id", "candidates.vie_position_id", "candidates.election_id",
                "candidates.user_id", "users.first_name", "users.last_name", "users.dp",
                "parties.party", "parties.party_image"
            ])->orderBy("candidates.id")->get();

        $womenReps = Candidates::where("vie_position_id", "=", 4)->join("users", function ($join) {
            $join->on("candidates.user_id", "=", "users.id");
        })->whereIn("users.constituency_id", $constituenciesInCounty)
            ->join("political_parties AS parties", function ($join) {
                $join->on("candidates.party_id", "=", "parties.id");
            })->select([
                "candidates.id", "candidates.vie_position_id", "candidates.election_id",
                "candidates.user_id", "users.first_name", "users.last_name", "users.dp",
                "parties.party", "parties.party_image"
            ])->orderBy("candidates.id")->get();

        // be from same constituency
        $mps = Candidates::where("vie_position_id", "=", 5)->join("users", function ($join) {
            $join->on("candidates.user_id", "=", "users.id");
        })->where("users.constituency_id", "=", $userConstituency)
            ->join("political_parties AS parties", function ($join) {
                $join->on("candidates.party_id", "=", "parties.id");
            })->select([
                "candidates.id", "candidates.vie_position_id", "candidates.election_id",
                "candidates.user_id", "users.first_name", "users.last_name", "users.dp",
                "parties.party", "parties.party_image"
            ])->orderBy("candidates.id")->get();

        $mcas = Candidates::where("vie_position_id", "=", 5)->join("users", function ($join) {
            $join->on("candidates.user_id", "=", "users.id");
        })->where("users.constituency_id", "=", $userConstituency)
            ->join("political_parties AS parties", function ($join) {
                $join->on("candidates.party_id", "=", "parties.id");
            })->select([
                "candidates.id", "candidates.vie_position_id", "candidates.election_id",
                "candidates.user_id", "users.first_name", "users.last_name", "users.dp",
                "parties.party", "parties.party_image"
            ])->orderBy("candidates.id")->get();



        // dd($constituenciesInCounty, $governors);

        if (auth()->user()->user_type_id == 1) {
        } else if (auth()->user()->user_type_id == 2) {
            return view(
                "voter/election",
                [
                    "presidents" => $presidents, "governors" => $governors, "senators" => $senators,
                    "womenRepresentatives" => $womenReps, "mps" => $mps, "mcas" => $mcas,
                    "voted" => 0,
                ]
            );
        }
    }
}
