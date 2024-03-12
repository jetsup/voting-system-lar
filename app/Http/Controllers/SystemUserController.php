<?php

namespace App\Http\Controllers;

use App\Models\Constituencies;
use App\Models\Counties;
use App\Models\Provinces;
use App\Models\User;
use Illuminate\Http\Request;

class SystemUserController extends Controller
{
    // get user profile data
    public function get_profile(Request $request)
    {
        $user = User::where("users.id", "=", auth()->user()->id)->get()[0];

        $constituency = Constituencies::where("id", "=", $user->constituency_id)->get(["constituency", "county_id"])[0];
        $user->constituency = $constituency->constituency;
        $user->county_id = $constituency->county_id;
        $county = Counties::where("id", "=", $user->county_id)->get(["county", "province_id"])[0];
        $user->county = $county->county;
        $user->province_id = $county->province_id;
        $province = Provinces::where("id", "=", $user->province_id)->get(["province"])[0];
        $user->province = $province->province;

        // dd($user);
        if (auth()->user()->user_type_id == 1) {
            return view("admin/profile", ["user" => $user]);
        } else {
            return view("voter/profile", ["user" => $user]);
        }
    }

    public function getVotersByLoc(Request $request)
    {
    }
}
