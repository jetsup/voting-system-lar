<?php

namespace App\Http\Controllers;

use App\Models\Elections;
use App\Models\PoliticalParties;
use App\Models\PoliticalPositions;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function getElections(Request $request)
    {
        $todayDate = Carbon::parse(Carbon::now())->format("Y-m-d H:m:s"); // TODO: get minutes
        $elections = Elections::where("start_date", ">", $todayDate)->where("election_status", "<=", 2/*upcoming or ongoing*/)
            ->join("election_types", "elections.election_type", "=", "election_types.id")
            ->get(["elections.*", "election_types.election_type"]);

        // dd($todayDate, $elections);
        return response()->json(["elections" => $elections]);
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
