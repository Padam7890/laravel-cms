<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function signup(Request $request){
        $validate = Validator::make($request->all(), [
            "name"=> "string|required",
            "email"=> "email|required|unique:users",
            "password"=> "string|required|min:8",
            ]);
        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            "message" => "User created successfully",
            "data" => $user
        ], 201);

    }
    public function login(Request $request) {
        $validate = Validator::make($request->all(), [
            "email"=> "email|required",
            "password"=> "string|required",
            ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 400);
        }

        if(Auth::attempt(["email"=>$request->email, "password"=>$request->password]))
        {
         /** @var \App\Models\MyUserModel $user **/
            $user = Auth::user();
            $token = $user->createToken("token")->plainTextToken;
            return response()->json([
                "message" => "User authenticated successfully",
                "access_token" => $token,
                "token_type" => "Bearer"
            ], 200);
        }
        else {
            return response()->json([
                "message" => "Invalid email or password"
            ], 401);
        }

    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            "message" => "User logged out successfully"
        ], 200);
    }
}
