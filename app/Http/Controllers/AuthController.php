<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
  use AuthenticatesUsers;
  
  public function register(Request $request)
  {
    $request->validate([
      'name' => ['required'],
      'email' => ['required', 'email', 'unique:users'],
      'password' => ['required', 'min:6', 'confirmed'],
      'password_confirmation' => ['required'],
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return ['message' => 'Registered successfully'];
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|string',
      'password' => 'required|string'
    ]);

    if(\Auth::attempt($credentials)){
      $user = \Auth::user();
      $token = $user->createToken('myapptoken')->plainTextToken;
      
      $response = [
          'user' => $user,
          'token' => $token
      ];
      
      return $response;
    }

    return ['message' => 'login failed'];
  }

  public function logout(Request $request)
  {
    //全トークンの削除
    \Auth::user()->tokens()->delete();

    \Auth::logout();
    return response()->json(['msg' => 'Logout Successfull']);
  }

  public function info()
  {
    $user = \Auth::user();

    $user_name = $user->name;
    $user_id =  $user->id;

    $data = [
      'user_name' => $user_name,
      'user_id' => $user_id,
    ];

    return [$data];
  }
}
