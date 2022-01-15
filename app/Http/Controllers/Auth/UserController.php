<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{


    //
    public function login(Request $request)
    {
        //$this->send

        $this->validate(
            $request,
            [
                'password' => 'required',

                'email' => 'required|email|max:255',


            ]
        );
        if (!Auth::attempt(['email' => $request->email, "password" => $request->password])) {
            return response(["message" => "failure", "data" => "invalid credentials", "statusCode" => Response::HTTP_UNAUTHORIZED]);
        } else {

            $userToken = Auth::user();

            //->createToken("token")->plainTextToken();
            //$getUser = User::where("email", '=', Auth::user()->email)->get()[0];
            $token = $userToken->createToken("token")->plainTextToken;
            return response([
                "message" => "success",  "data" => ["user" => $userToken], "accessToken" => $token,
                "statusCode" => Response::HTTP_OK
            ]);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        //s$user->tokens()->delete();
        return response(["message" => "success", "data" => "logout out successfully", "statusCode" => Response::HTTP_OK], Response::HTTP_ACCEPTED);
    }
}
