<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //

    public function register(Request $request)
    {
        // $this->validate($request, [
        //     [
        //         'email' => "required|email",
        //         'password' => "required",
        //         'name' => "required"
        //     ]
        // ]);
        $user = User::create(['email' => $request->email, 'name' => $request->name, "password" => $request->password]);

        $token = $user->createToken("token")->plainTextToken;
        return response([
            "message" => "success",  "data" => ["user" => $user, "accessToken" => $token],
            "statusCode" => Response::HTTP_OK
        ]);
    }

    public function login()
    {
        return "Am here";
    }
}
