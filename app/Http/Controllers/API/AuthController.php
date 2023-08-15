<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends BaseController
{
    public function register(Request $request){
        $post_data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:user',
            'password'=>'required|min:8',
            'role'=>'in:admin,user',
        ]);
        $user = User::create([
            'name' => $post_data['name'],
            'email' => $post_data['email'],
            'password' => Hash::make($post_data['password']),
            'role'=> $post_data['role'],
        ]);
        $token = $user->createToken(env('APP_KEY'))->plainTextToken;
        return $this->sendResponse([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError('Invalid login details');
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken(env('APP_KEY'))->plainTextToken;
        return $this->sendResponse([
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);
    }
}