<?php

namespace App\Http\Controllers;

use App\Models\Complains;
use Illuminate\Http\Request;

class ComplainsController extends Controller
{
    public function getComplains()
    {
        $complains = Complains::orderBy("complains.id")->where("resolved", "=", false)->join("users", function ($join) {
            $join->on("complains.from", "=", "users.id");
        })->select(["complains.id", "users.first_name", "users.last_name", "complains.complain"])
            ->get();
        return view("admin/view-complain", ["complains" => $complains]);
    }

    public function resolveComplain(Request $request)
    {
        $complainID = $request->input("complain-id");
        $resolved = Complains::where("id", "=", $complainID)->update(["resolved" => true]);
        if ($resolved) {
            return back()->with("success", "Complain #$complainID resolved successfully!");
        } else {
            return back()->with("error", "Could not resolve the complain!!");
        }
    }

    public function complain(Request $request)
    {
        if ($request->method() == "POST") {
            $complain = $request->input("complain");
            $complainCreated = Complains::create(["from" => auth()->user()->id, "complain" => $complain]);

            if ($complainCreated) {
                return back()->with("message", "Complain filed successfully!");
            } else {
                return back()->with("error", "Complain creation failed!");
            }
        } else if ($request->method() == "GET") {
            if (auth()->user()->user_type_id == 1) {
                return view("admin/complain");
            } else {
                $complains = Complains::where("from", "=", auth()->user()->id)->get();
                // dd($complains);
                return view("voter/complain", ["complains" => $complains]);
            }
        }
    }
}
