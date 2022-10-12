<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create()
    {
        return view("auth.register");
    }
    public function store()
    {
        $registerData=request()->validate([
            "username"=>["required","max:255","min:5","starts_with:@,bar",Rule::unique("users", "username")],
            "name"=>["required","max:255","min:5"],
            "email"=>["required","email",Rule::unique("users", "email")],
            "password"=>["required","max:255","min:4"],
        ]);

        $user=User::create($registerData);


        //create account still login
        auth()->login($user);

        // session()->flash("success", "Welcome".$user->name);
        return redirect("/")->with("success", "Welcome ".$user->name."🎉");

        // print_r($registerData);
        // echo "success";
    }

    public function login()
    {
        return view("auth.login");
    }

    public function user_login()
    {
        $loginData=request()->validate(
            [
            "email"=>["required","email",Rule::exists("users", "email")],
            "password"=>["required","min:4","max:255"]
        ],
            // Change Laravel Custom Error Message
            [
               "email.required"=>"Email is Invalid!"
            ]
        );

        if (auth()->attempt($loginData)) {
            if (auth()->user()->is_admin) {
                return redirect("/admin/blogs/create");
            } else {
                $loginUser=auth()->user()->name;
                return redirect("/")->with("success", "Welcome Back ".$loginUser."🤗");
            }
        } else {
            return redirect()->back()->withErrors(["email"=>"User Credentials Wrong"]);
        }
    }


    public function logout()
    {
        $currentUser=auth()->user()->name;
        auth()->logout();
        return redirect("/")->with("success", "Good Bye ".$currentUser."👋");
    }
}
