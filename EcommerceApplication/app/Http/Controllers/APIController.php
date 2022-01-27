<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:8|max:12|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            $user = new User;
            // $user->user_id = $request->user()->id;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 5;
            if ($user->save()) {
                return response(['data' => new UserResource($user), "Message" => "Entry created sucessfully"], 201);
            } else {
                return response(['msg' => 'Data not added'], 401);
            }
        }
    }

    public function login(Request $request)
    {
        // $creds = $req->only(['email', 'password']);

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Incorrect email/password'], 401);
        }

        $status = User::where('email', $request->email)->first()->status;
        if ($status == 0) {
            return response()->json(['error' => 'Your A/C is blocked. Please contact Admin.'], 401);
        }

        $msg = "Login Successful";

        return $this->respondWithToken($token, $msg);
        // return response()->json(['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|alpha_num|min:8|max:12',
            'password' => 'required|alpha_num|min:8|max:12|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $user1 = User::where('id', $request->user_id)->first();
            $user1
                = $user1->makeVisible(['password']);
            // return response(['data' => Hash::make($request->confirm_password), "Message" => "Password updated sucessfully"], 201);

            if (Hash::check($request->old_password, $user1->password)) {
                $form_data = array(
                    'password' => Hash::make($request->password),
                );

                $user1 = $user1->update($form_data);

                return response(['data' => $user1, "Message" => "Password updated sucessfully"], 201);
            } else {
                return response(['data' => $user1, 'msg' => 'Password not updated'], 401);
            }
        }
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully logged out.']);
    }

    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    public function profile()
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token, $msg)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'msg' => $msg
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
