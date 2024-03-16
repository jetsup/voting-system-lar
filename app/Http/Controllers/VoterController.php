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

    public function getVoters(Request $request, $queryTypeID, $placeID)
    {
        if ($queryTypeID == 0) {
            // province
            $countiesIDs = Counties::where("province_id", "=", $placeID)->get("id")->pluck("id")->toArray();
            $constituenciesIDs = Constituencies::whereIn("county_id", $countiesIDs)->get("id")->pluck("id")->toArray();
            $voters = User::whereIn("constituency_id", $constituenciesIDs)->join("constituencies", function ($join) {
                $join->on("users.constituency_id", "=", "constituencies.id");
            })->leftJoin("counties", function ($join) {
                $join->on("constituencies.county_id", "=", "counties.id");
            })->leftJoin("provinces", function ($join) {
                $join->on("counties.province_id", "=", "provinces.id");
            })->select("users.*", "constituencies.constituency AS constituency", "counties.county AS county", "provinces.province AS province")->get();
        } else if ($queryTypeID == 1) {
            // county
            $constituenciesIDs = Constituencies::where("county_id", "=", $placeID)->get("id")->pluck("id")->toArray();
            $voters = User::whereIn("constituency_id", $constituenciesIDs)->join("constituencies", function ($join) {
                $join->on("users.constituency_id", "=", "constituencies.id");
            })->leftJoin("counties", function ($join) {
                $join->on("constituencies.county_id", "=", "counties.id");
            })->leftJoin("provinces", function ($join) {
                $join->on("counties.province_id", "=", "provinces.id");
            })->select("users.*", "constituencies.constituency AS constituency", "counties.county AS county", "provinces.province AS province")->get();
        } else if ($queryTypeID == 2) {
            // constituency
            $voters = User::where("constituency_id", "=", $placeID)->join("constituencies", function ($join) {
                $join->on("users.constituency_id", "=", "constituencies.id");
            })->leftJoin("counties", function ($join) {
                $join->on("constituencies.county_id", "=", "counties.id");
            })->leftJoin("provinces", function ($join) {
                $join->on("counties.province_id", "=", "provinces.id");
            })->select("users.*", "constituencies.constituency AS constituency", "counties.county AS county", "provinces.province AS province")->get();
        }
        // dd($voters);
        return response()->json(["voters" => $voters]);
    }

    public function searchVoter(Request $request, $idNumber)
    {
        $voter = User::where("id_number", "=", $idNumber)->join("constituencies", function ($join) {
            $join->on("users.constituency_id", "=", "constituencies.id");
        })->leftJoin("counties", function ($join) {
            $join->on("constituencies.county_id", "=", "counties.id");
        })->leftJoin("provinces", function ($join) {
            $join->on("counties.province_id", "=", "provinces.id");
        })->select("users.*", "constituencies.constituency AS constituency", "counties.county AS county", "provinces.province AS province")->first();
        if ($voter) {
            // dd($voter);
            return response()->json(["voter" => $voter]);
        } else {
            return response()->json(["voter" => $voter]);
        }
    }
}
