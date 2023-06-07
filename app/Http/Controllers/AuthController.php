<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;

class AuthController extends Controller {
    public function login(LoginRequest $request) {
        try {
            $credentials = $request->only('username', 'password');
            // dd($credentials);
            if (! $token = auth()->guard('api')->attempt($credentials)) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Wrong username/password',
                ], 422);
            }
            return response()->json([
                "status" => 200,
                "message" => "Success!",
                "data" => [
                    "user" => auth()->guard('api')->user(),
                    "token" => $token
                ]
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "status" => 400,
                "message" => $e->getMessage()
            ], 400);
        }
    }

    public function register(Request $request) {
        try {
            $name = $request['name'];
            $username = $request['username'];
            $email = $request['email'];
            $password = Hash::make($request['password']);
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => 'Super Admin'
            ]);
            return response()->json([
                "status" => 200,
                "message" => "Success!",
                "data" => [
                    "user" => $user
                ]
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "status" => 400,
                "message" => $e->getMessage()
            ], 400);
        }
    }
    public function unauthorized (Request $request) {
        return response()->json([
            "status" => 401,
            "message" => 'Unauthorized'
        ], 401);
    }
    public function validationError()
    {
        return response()->json([
            'status' => 422,
            'message' => 'Validation error'
        ], 422);
    }
}