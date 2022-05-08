<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'uniqno' => 'required|string',
            'username' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        try {
            $pdo = DB::connection()->getPdo();
            $user = new User;
            $user->uniqno = $request->input('uniqno');
            $user->username = $request->input('username');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();
            //$rowId = $pdo->lastInsertId();
           // $user_profile =DB::insert('insert into user_profile (uid) value (?)',[$rowId]);
            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 402);
        }

    }


    
     /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);
        //$user = User::where('username', '=', $credentials['username'])->first();
        //$customClaims = ['role' => $user->uniqno];

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


}