<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
class Controller extends BaseController
{
    //Add this method to the Controller class
protected function respondWithToken($token)
{
    return response()->json([
        'token' => $token,
        'token_type' => 'bearer',
        'expires_in' => Auth::factory()->getTTL() * 60
    ], 200);
}

}
