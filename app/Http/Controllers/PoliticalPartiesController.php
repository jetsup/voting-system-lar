<?php

namespace App\Http\Controllers;

use App\Models\PoliticalParties;
use App\Models\User;
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
            if ($party_leader == null) {
                $party_leader = 1;
            }

            $userID = User::where("id_number", "=", $party_leader)->first();
            $userID = $userID == null ? 1 : $userID->id;

            $party_image = $party_logo ? $party_logo->store("images/parties", "public") : "images/elections/political_parties.jpg";
            $party = PoliticalParties::create([
                "party" => $party_name,
                "slogan" => $slogan,
                "party_leader" => $userID,
                "party_image" => $party_image,
                "election_id" => $election_id
            ]);

            if ($party) {
                return back()->with("success", "Successfully created the party");
            } else {
                return back()->with("error", "Could not create the party");
            }
        } else if ($request->method() == "GET") {
            return view("admin/create-party", []);
        }
    }
}
