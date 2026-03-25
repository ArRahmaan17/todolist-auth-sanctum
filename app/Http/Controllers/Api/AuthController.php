<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Sign in",
     *     tags={"Authentication"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="Secret123")
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="Login successful"),
     *     @OA\Response(response=401, description="Invalid credentials")
     * )
     */
    public function authentication(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => "your credentials doesn't match to our records",
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'you are successfully login',
            'user' => $user,
            'token' => $token,
        ], 200)->cookie('logged', true, 120);
    }

    /**
     * @OA\Post(
     *     path="/api/registration",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="name", type="string", example="User Name"),
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="Secret123")
     *         )
     *     ),
     *
     *     @OA\Response(response=200, description="Registration successful"),
     *     @OA\Response(response=401, description="Registration failed")
     * )
     */
    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to create your account, please try again',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'we successfully creating your account',
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Sign out",
     *     tags={"Authentication"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(response=200, description="Logout successful"),
     *     @OA\Response(response=501, description="Logout failed")
     * )
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        if (! $user->currentAccessToken()->delete()) {
            return response()->json([
                'status' => false,
                'message' => 'we failed to logout your from the website',
            ], 501);
        }

        return response()->json([
            'status' => true,
            'message' => 'you successfully logged out from the website',
        ], 200);
    }
}
