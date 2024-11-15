<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registerUser(Request $request)
    {

        $name = $request->get("name");
        $email = $request->get("email");
        $password = $request->get("password");

        $newUser = new User(["name" => $name, "email" => $email, "password" => $password]);

        $validation = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email:rfc,dns|unique:App\Models\User,email',
            'password' => 'required'
        ]);

        $newUser->save();

        if (Auth::attempt($validation)) {
            $request->session()->regenerate();
            return response()->json(["message" => "User has been successfully created."], 200);
        }

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => ["required", "string", "email:rfc,dns"],
            "password" => ["required"]
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = new User();
            $userLoggingIn = $user->findUser(($request->get("email")));

            foreach($userLoggingIn->roles as $role) {
                if($role->name == "admin") {
                    $isAdmin = true;
                }
            }

            return response()->json(["message" => "Successfully logged in", "admin"=>$isAdmin], 200);
        }

        return response()->json(["password" => ["Authentication failed. Check your login credentials."]], 419);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(["message" => "Logged out."], 200);
    }
}
