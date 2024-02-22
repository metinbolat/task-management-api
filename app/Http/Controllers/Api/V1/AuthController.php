<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $user = new UserResource($request->user());
        $user->tokens()->delete();
        if ($user->email === 'admin@adminmail.com') {
            $token = $user->createToken('admin-token');
        } else {
            $token = $user->createToken('user-token', ['list-tasks', 'view-tasks', 'update-task-status']);
        }

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        if ($user->email === 'admin@adminmail.com') {
            $token = $user->createToken('admin-token');
        } else {
            $token = $user->createToken('user-token', ['list-tasks', 'view-tasks', 'update-task-status']);
        }

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }
}
