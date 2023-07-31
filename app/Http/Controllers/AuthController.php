<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        // $credentials = User::with('organization', 'userType')
        //                 ->where('email', $request->input('userName'))
        //                 ->get();

        // // return response()->json($credentials);


        // $hashedpass = Hash::make($request->input('password'));
        // User::where('user_name', $request->input('userName'))->update(['password'=> $hashedpass]);

        // $credentials1 = $request->only('user_name', 'password');

        // if (Auth::attempt($credentials1)) {
        //    // Authentication successful. The user is now logged in.
        //    return "success";
        // } else {
        //     // Authentication failed. Handle the failed login attempt.
        //     return "failed";
        // }

        $credentials = $request->only('userName', 'password');

        $user = new User();

        // Retrieve the user using the custom findForLogin method
        $user = $user->findForLogin($credentials['userName']);

        if ($user && Auth::attempt(['user_name' => $user->user_name, 'password' => $credentials['password']])) {
            // Authentication successful. The user is now logged in.
            return "success";
        } else {
            // Authentication failed. Handle the failed login attempt.
            return "failed";
        }

    }
    }
