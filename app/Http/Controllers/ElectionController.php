<?php

namespace App\Http\Controllers;

use App\Models\Elections;
use App\Models\ElectionTypes;
use App\Models\PoliticalParties;
use App\Models\PoliticalPositions;
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

    public function modifyElection()
    {
        $upcomingElections = Elections::whereIn("election_status", [1, 2, 3]/*upcoming|ongoing|postponed*/)->get();
        return view("admin/modify-election", ["elections" => $upcomingElections]);
    }

    public function getElections(Request $request, $electionStatusID)
    {
        if ($electionStatusID == 1) { // upcoming
            $todayDate = Carbon::parse(Carbon::now())->format("Y-m-d H:i:s");

            $elections = Elections::where("start_date", ">", $todayDate)->orderBy("elections.start_date", "desc")->where("election_status", "=", $electionStatusID)
                ->join("election_types", "elections.election_type", "=", "election_types.id")
                ->get(["elections.*", "election_types.election_type"]);
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

    public function getPartyLogo(Request $request, $partyID)
    {
        $logo = PoliticalParties::where("id", "=", $partyID)->first("party_image");
        return response()->json(["logo" => $logo]);
    }
}
