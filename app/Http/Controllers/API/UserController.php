<?php

namespace App\Http\Controllers\API;

use Auth;
use Carbon\Carbon;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public $successStatus = 200;

    public function register (Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
    
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
    
        $request['password']=Hash::make($request['password']);
        $user = User::create($request->toArray());
    
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
    
        return response($response, 200);
    
    }

    public function login(Request $request){

        $request->validate([
                    'email' => 'required|string|email',
                    'password' => 'required|string'
                ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                    'message' => 'Unauthorized'
            ], 401);
        }

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::User();
            $createdToken = $user->createToken('News Application');
            $token = $createdToken->token;
            $token->expires_at = Carbon::now()->addWeeks(1);

            $token->save();
      
            return response()->json([
            'access_token' => $createdToken->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $createdToken->token->expires_at)->toDateTimeString()],
                $this->successStatus
            );
        }
    }

    public function details()
    {
        $user = Auth::User();
        return response()->json(['detail user' => $user], $this->successStatus);
    }

    public function logout (Request $request) {

        $token = $request->user()->token();
        $token->revoke();
    
        $response = 'berhasil keluar aplikasi';
        return response($response, 200);
    
    }
    
}
