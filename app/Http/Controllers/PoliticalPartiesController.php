<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliticalPartiesController extends Controller
{
    //
    public function create(Request $request)
    {
        if ($request->method() == "POST") {
            $party_logo = $request->file("logo");
            $party_name = $request->input("party-name");
            $slogan = $request->input("slogan");
            $party_leader = $request->input("party-leader");
            $election_id = $request->input("election-id");
// FIXME: apply form validation

            dd($party_logo, $party_name, $slogan, $party_leader, $election_id);
        } else if ($request->method() == "GET") {
            return view("admin/create-party", []);
        }
    }
}
