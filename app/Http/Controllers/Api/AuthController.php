<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authentication(LoginRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        $user = User::whereEmail($credentials['email'])->first();
        if (! $credentials || ! Hash::check($credentials['password'], $user->password)) {
            $responses = ['status' => false, 'message' => "your credentials doesn't match to our records"];

            return Response()->json($responses, 401);
        }
        $token = $user->createToken('token')->plainTextToken;
        $responses = ['status' => true, 'message' => 'you are successfully login', 'user' => $user, 'token' => $token];

        return Response()->json($responses, 200)->cookie('logged', true, 120);
    }

    public function registration(Request $request)
    {
        $request->validate(['name' => 'required', 'email' => 'required|unique:users,email', 'password' => 'required']);
        $data = ['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'user_privileges' => false];
        if (! User::createAdminUser($data)) {
            $response = ['status' => false, 'message' => 'we failed to create your account, please try again'];

            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'message' => 'we successfully creating your account'];

        return Response()->json($response, 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $token = $user->tokens()->get()->toArray();
        if (! $user->tokens()->where('id', $token[0]['id'])->delete()) {
            $response = ['status' => false, 'message' => 'we failed to logout your from the website'];

            return Response()->json($response, 501);
        }
        $response = ['status' => true, 'message' => 'you successfully logged out from the website'];

        return Response()->json($response, 200);
    }
}
