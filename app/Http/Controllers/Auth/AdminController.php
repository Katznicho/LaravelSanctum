<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\HasApiTokens;

class AdminController extends Controller
{
    //
    public function index()
    {
        $sample = AdminModel::all();
        // return
        return $sample;
    }




    public function login(Request $request)
    {

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
            $token = $userToken->createToken("token")->plainTextToken;
            return response([
                "message" => "success",  "data" => ["user" => Auth::user(), "accessToken" => $token],
                "statusCode" => Response::HTTP_OK
            ]);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return response(["message" => "success", "data" => "logout out successfully", "statusCode" => Response::HTTP_OK], Response::HTTP_ACCEPTED);
    }
}
