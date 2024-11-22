<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends BaseController
{

    public function __construct()
    {

    }


    public function register(Register $request)
    {

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);
        $token = $user->createToken('token')->plainTextToken;
        return $this->sendSuccess(
            __('auth.register_success'),
            ['token' => $token, 'user' => new UserResource($user),]);
    }


    public function login(Login $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('token')->plainTextToken;
            return $this->sendSuccess(
                __('auth.login_success'),
                ['token' => $token, 'user' => new UserResource($user),]);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function profile()
    {
        return $this->sendSuccess(
            __('auth.profile_success'),
            ['user' => new UserResource(auth()->user())],
        );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
