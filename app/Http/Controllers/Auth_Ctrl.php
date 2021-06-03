<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Auth_Ctrl extends Controller
{
    public function register(Request $r){
        $fields = $r->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',//'unique' checks on 'users' table 'email' field
            'password' => 'required|string|confirmed',//'confirmed' requires password_confirm
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapp-token', ['server:update'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response( $response, 201 );
    }

    public function login(Request $r){
        $fields = $r->validate([ 
            'email' => 'required|string',//'unique' checks on 'users' table 'email' field
            'password' => 'required|string',//'confirmed' requires password_confirm
        ]);

        //check email
        $user = User::where('email', $fields['email'])->first();

        //check password
        if( !$user || !Hash::check($fields['password'], $user->password) ) {
            return response()->json(['message'=>'Invalid credentials'], 401);
        }

        $token = $user->createToken('myapp-token', ['server:update'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response( $response, 201 );
    }
    
    public function logout(Request $r){
        auth()->user()->tokens()->delete();

        return response(['message'=>'Logged out'],200);
    }

    public function info(Request $r){
        $user = auth()->user();
        if ($user->tokenCan('server:update')) {
            return $r->user();
        }

        return response(['asdfasdf'],303);
    }
}
