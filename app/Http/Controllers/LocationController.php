<?php

namespace App\Http\Controllers;

use App\Models\Constituencies;
use App\Models\Counties;
use App\Models\Provinces;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function get_provinces(Request $request)
    {
        $provinces = Provinces::all(["id", "province"]);
        return response()->json($provinces);
    }
    public function get_counties(Request $request, $provinceID)
    {
        $counties = Counties::where("province_id", "=", $provinceID)->get(["id", "county", "province_id"]);
        return response()->json($counties);
    }
    public function get_constituencies(Request $request, $countyID)
    {
        $constituencies = Constituencies::where("county_id", "=", $countyID)->get(["id", "constituency", "county_id"]);
        return response()->json($constituencies);
    }
}
