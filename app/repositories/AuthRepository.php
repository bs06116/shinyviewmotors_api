<?php
/**
 * Created by PhpStorm.
 * User: asimr
 * Date: 7/8/2019
 * Time: 1:34 AM
 */

namespace App\repositories;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;

class AuthRepository
{
    public function __construct()
    {

    }
    public  function  userLogin(Request $request){

        $credentials = $request->only('email', 'password');
        if ($token = Auth::guard()->attempt($credentials)) {
            return $token;
           // return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
       return  '';
//        $input = $request->only('email', 'password');
//
//        $jwt_token = null;
//
//        if (!$jwt_token = JWTAuth::attempt($input)) {
//            return $jwt_token;
//        }
//
//       return $jwt_token;
    }


}
