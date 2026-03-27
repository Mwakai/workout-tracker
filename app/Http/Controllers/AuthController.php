<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Auth instance
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    // Login user and return a token
    public function login() {
        $credentials = request([
            'email',
            'password'
        ]);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => "Unauthorized"], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me() {
        return response()->json(auth()->user());
    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     */
    public function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>auth()->factory()->getTTL() * 60
        ]);
    }
}
