<?php

namespace App\Http\Controllers;

use App\Models\Constituencies;
use App\Models\Counties;
use App\Models\Provinces;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
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
        // make dp not required and use a default avatar img
        $dpFile = $request->file("dp");
        $imagePath = $dpFile ? $dpFile->store("images/dp", "public") : "/images/user.png";
        $formFields["dp"] = $imagePath;

        // hash the password
        $formFields["password"] = bcrypt($formFields["password"]);
        // dd($formFields);
        // create the user
        $user = User::create($formFields);

        // redirect back to adding new user
        return back("/")->with("message", "Voter added successfully!");
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
