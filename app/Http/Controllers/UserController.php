<?php

namespace App\Http\Controllers;

use App\Models\Constituencies;
use App\Models\Counties;
use App\Models\Provinces;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "first_name" => ["required", "min:3"],
            "last_name" => ["required", "min:3"],
            // "middle_name" => ["min:3"],
            "id_number" => ["required", "min:6", Rule::unique("users", "id_number")],
            // specify that the gender input can either be 1,2 or 3
            "gender_id" => ["required", Rule::in([1, 2])],
            "dob" => ["required"],
            "constituency_id" => ["required"],
            "ward" => ["required"],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "phone" => ["required", Rule::unique("users", "phone")],
            "user_type_id" => ["required"],
            // ensure it is a strong password
            "password" => ["required", "min:8", "confirmed", "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/"],
            // "account_type_id" => [Rule::in([0, 1, 2])],
            "dp" => ["image", "mimes:jpeg,png,jpg,gif,svg", "max:6144"],
        ]);
        $birthdate = Carbon::parse($formFields["dob"]);
        $eighteenYearsAgo = Carbon::now()->subYears(18);
        $isEighteenOrAbove = $birthdate->lte($eighteenYearsAgo);

        if(!$isEighteenOrAbove){
            // dd("YOUNG");
            return back()->with("error", "The user is under age");
        }

        // dd($formFields["dob"], $birthdate);
        // make dp required and use a default avatar img
        $dpFile = $request->file("dp");
        $imagePath = $dpFile ? $dpFile->store("images/dp", "public") : "/images/user.png";
        $formFields["dp"] = $imagePath;

        // store middle name if available
        if ($request->has("middle_name")) {
            $formFields["middle_name"] = $request->middle_name;
        }

        // create a remember token
        $formFields["remember_token"] = Str::random(10);

        // hash the password
        $formFields["password"] = bcrypt($formFields["password"]);
        // dd($formFields);
        // create the user
        
        $user = User::create($formFields);

        // dd($user);

        // redirect back to adding new user
        return back()->with("message", "Voter added successfully!");
    }

    public function update(Request $request)
    {
        $idNumber = $request->input("id_number");

        $formFields = $request->validate([
            // assumption is that user cannot change their names
            "constituency_id" => ["required"],
            "ward" => ["required"],
            // TODO: check before update if the email and phone in database
            "email" => ["required",],
            "phone" => ["required"],
            "id_number"=> ["required"],
            "user_type_id" => ["required", Rule::in([0, 1, 2])],

            // password can only be updated from voters profile

            // dp can be null if it was not updated
            // "dp" => ["image", "mimes:jpeg,png,jpg,gif,svg", "max:6144"],
        ]);

        // make dp required and use a default avatar img
        $dpFile = $request->file("dp");
        if (!is_null($dpFile)) {
            $imagePath = $dpFile->store("images/dp", "public");
            $formFields["dp"] = $imagePath;
        }

        // store middle name if available
        if ($request->has("middle_name")) {
            $formFields["middle_name"] = $request->middle_name;
        }

        // create a remember token
        $formFields["remember_token"] = Str::random(10);

        User::where("id_number", "=", $idNumber)->update($formFields);

        // redirect back to finding new user
        return back()->with("message", "Voter updated successfully!");
    }

    // logout the user
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect to home page
        return redirect('/')->with('message', 'You have been logged out!');
    }

    public function signin(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'min:3'],
            'password' => ['required', 'min:8'],
        ]);

        // attempt to login the user
        if (!auth()->attempt($formFields)) {
            return back()->withErrors([
                'error' => 'User with those credentials does not exist',
            ])->onlyInput();
        } else {
            // redirect to home page or the intended page
            return redirect()->intended('/')->with('message', 'Welcome, ' . auth()->user()->email . '!');
        }
    }
}
