<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\repositories\AuthRepository;
use Illuminate\Support\Facades\Input;
use App\Exceptions\Handler;
use Auth;
use Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct(AuthRepository $auth)
    {
        $this->auth=$auth;
    }
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 400);
        }
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['status' => 'success'], 200);
    }
    public function updateUser(Request $request)
    {
        $rules = array(
            'first_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'sometimes:min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'sometimes:min:6'
        );
        $messages = array(
           'first_name.required' => '<p>Please enter  First name.</p>',
            'email.required' => '<p>Please enter email.</p>',
            'email.unique' =>'<p>Email already exits.</p>' ,

        );
        $input = $request->all();

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $user = User::find(Auth::user()->id);
        $user->user_name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return response()->json(['status' => 'success','message'=>'Your profile has been update successfully.'], 200);
    }
    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
        try {
            $token=$this->auth->userLogin($request);
            if($token){
                $user = User::find(Auth::user()->id);

                return response()->json(['status' => 'success','user_info'=>$user,'access_token' =>$token], 200)->header('Authorization', $token);
            }else{
                return response()->json(['error' => 'login_error'], 400);
            }
        } catch (\Exception $e) {
            // Anything that went wrong
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
 }
