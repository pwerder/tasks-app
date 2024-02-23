<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Trait\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        if (Auth::attempt($request->only("email","password"))) {
            return $this->response(200, "Authorized", [
                auth()->user()->createToken("assignments")->plainTextToken
            ]);
        }

        return $this->response(403, "Not authorized");
    }

    public function logout(Request $request)
    {
        return auth()->user()->currentAccessToken()->delete();
    }
}
