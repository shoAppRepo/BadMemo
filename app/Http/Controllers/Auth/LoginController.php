<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        // $user = User::where('email', $fields['email'])->first();

        // Check password
        // if(!$user || !Hash::check($fields['password'], $user->password)) {
        //     return response([
        //         'message' => 'Bad creds'
        //     ], 401);
        // }

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

    public function logout(Request $request) {
        // auth()->user()->tokens()->delete();

        Auth::logout();

        return [
            'message' => 'Logged out'
        ];
    }
}
