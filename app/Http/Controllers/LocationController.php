<?php

namespace App\Http\Controllers;

use App\Models\Constituencies;
use App\Models\Counties;
use App\Models\Elections;
use App\Models\Provinces;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function getProvinces(Request $request)
    {
        $provinces = Provinces::all(["id", "province"]);
        return response()->json($provinces);
    }
    public function getCounties(Request $request, $provinceID)
    {
        $counties = Counties::where("province_id", "=", $provinceID)->get(["id", "county", "province_id"]);
        return response()->json($counties);
    }
    public function getConstituencies(Request $request, $countyID)
    {
        $constituencies = Constituencies::where("county_id", "=", $countyID)->get(["id", "constituency", "county_id"]);
        return response()->json($constituencies);
    }

    public function getPlaces(Request $request, $queryFor/*1-4=>counties, >4=>constituencies*/, $electionID)
    {
        if ($queryFor > 0 && $queryFor <= 4) {
            // get counties to where the election is being held
            $places = Elections::where("elections.id", "=", $electionID)->join("counties", function ($join) {
                $join->on("elections.county_id", "=", "counties.id");
            })
            ->select(["elections.*", "counties.id AS county_id", "counties.county AS county"])->get();
        } else {
            // get constituencies to where the election is being held
        }
        dd($places);
        return response()->json(["places" => $places]);
    }
}
