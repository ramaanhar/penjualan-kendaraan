<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;
use Hamcrest\Core\IsTypeOf;

class AuthController extends Controller {
    public function login(LoginRequest $request) {
        try {
            $credentials = $request->only('username', 'password');
            // dd($credentials);
            if (! $token = auth()->guard('api')->attempt($credentials)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Wrong username/password',
                ], 401);
            }
            // $username = $validated['username'];
            // $password = $validated['password']; 
            // $userData = User::where('username', $username)->firstOrFail();
            // // if (! isset($userData[0])) {
            // if (! isset($userData)) {
            //     return response()->json([
            //         "status" => "404",
            //         "message" => "User not found"
            //     ]);
            // }
            // // $user = User::find($userData[0]['id']);
            // // if (! Hash::check($password, $user['password'])) {
            // if (! Hash::check($password, $userData['password'])) {
            //     return response()->json([
            //         "status" => "400",
            //         "message" => "Wrong password"
            //     ]);
            // }
            
            
            // $token = $userData->createToken('auth_token')->plainTextToken;
            return response()->json([
                "status" => "200",
                "message" => "Success!",
                "data" => [
                    "user" => auth()->guard('api')->user(),
                    "token" => $token
                ]
            ]);
        } catch (HttpException $e) {
            return response()->json([
                "status" => "400",
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
            // dd([$name, $username, $email, $password]);
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
                "status" => "400",
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
}