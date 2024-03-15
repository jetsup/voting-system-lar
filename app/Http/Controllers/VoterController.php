<?php

namespace App\Http\Controllers;

use App\Models\Constituencies;
use App\Models\Counties;
use App\Models\User;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    public function editVoter(Request $request)
    {
        $idNumber = $request->input("id_number");
        $voter = User::where("id_number", "=", $idNumber)->join("constituencies AS constituency", function ($join) {
            $join->on("users.constituency_id", "=", "constituency.id");
        })->leftJoin("counties AS county", function ($join) {
            $join->on("constituency.county_id", "=", "county.id");
        })->leftJoin("provinces AS province", function ($join) {
            $join->on("county.province_id", "=", "province.id");
        })->first();

        if ($voter) {
            return view("admin/update-voter", ["voter" => $voter]);
        } else {
            return back()->with("error", "No user with ID Number " . $idNumber . " in the database!");
        }
    }

    public function getVoters(Request $request)
    {
        $provinceID = $request->input("province");
        $countyID = $request->input("county_id");

        if ($countyID) {
            $constituencyID = $request->input("constituency");
            if ($constituencyID) {
                // all provided
                $voters = User::where("constituency_id", "=", $constituencyID)->get(["dp", "id_number", "first_name", "last_name", "middle_name", "gender_id", "dob"]);
            } else {
                // only county and province
                $constituenciesIDs = Constituencies::where("county_id", "=", $countyID)->get("id");
                $voters = User::where("constituency_id", "IN", $constituenciesIDs)->get(["dp", "id_number", "first_name", "last_name", "middle_name", "gender_id", "dob"]);
            }
        } else {
            // just province provided
        }
    }
}
