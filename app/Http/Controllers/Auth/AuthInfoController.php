<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthInfoController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  public function info()
  {
    $user = \Auth::user();
    
    $user_name = $user->name;
    $user_id =  $user->id;

    return compact($user_name, $user_id);
  }
}
