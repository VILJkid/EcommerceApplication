<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return UserResource::collection(User::all());
        $data = User::latest()->get();
        return response(['data' => UserResource::collection($data), "Message" => "Fetched all the data"], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {

            $user = new User;
            $user->user_id = $request->user()->id;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;
            if ($user->save()) {
                return response(['data' => new UserResource($user), "Message" => "Entry created sucessfully"], 201);
            } else {
                return response(['msg' => 'Data not added']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return new UserResource($user);
        return response(['data' => new UserResource($user), "Message" => "Fetched the specified result"], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->user()->id !== $user->user_id) {

            return response()->json(['error' => 'You can only edit your own details.'], 403);
        }


        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $newuser = User::find($user->user_id);
            $newuser->firstname = $request->firstname;
            $newuser->lastname = $request->lastname;
            $newuser->email = $request->email;
            $newuser->password = Hash::make($request->password);
            $newuser->role_id = $request->role_id;
            if ($newuser->save()) {
                return response(['data' => new UserResource($newuser), "Message" => "Entry updated sucessfully"], 201);
            } else {
                return response(['msg' => 'Data not updated']);
            }
        }


        // $user->update($request->only(['firstname', 'lastname', 'email', 'password', 'role_id']));



        // return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->user()->id != $user->user_id) {
            return response()->json(['error' => 'You can only delete your own details.'], 403);
        }
        $user->delete();
        // return response()->json(null, 204);
        return response(['data' => new UserResource($user), "Message" => "Entry deleted sucessfully"], 200);
    }
}
