<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class Users extends Controller
{
    //Add User
    public function addUser()
    {
        $atData = UserRole::orderBy('id')->get();
        return view("AdminPanel.Pages.addUser", ['atData' => $atData]);
    }

    //Validation part for adding User
    public function addUser_check(Request $req)
    {
        $validatedData = $req->validate([
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:8|max:12|confirmed',
            'password_confirmation' => 'required',
            'userRole_id' => 'required',
        ]);

        if ($validatedData) {
            $user = new User;
            // $user->user_id = $request->user()->id;
            $user->firstname = $req->firstname;
            $user->lastname = $req->lastname;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->role_id = $req->userRole_id;
            $user->status = $req->userstatus;
            if (!$user->save())
                return back()->with('error', "User Database error");

            return back()->with('success', "User Addedd successfully");
        }
        // return response()->json(['dasj', $req->all()]);
    }

    //Display Users
    public function showUsers(Request $request)
    {
        $aData = User::latest('updated_at')->paginate(4);
        return view("AdminPanel.Pages.showUsers", ['aData' => $aData]);
        // return response()->json(['dasj', $aData[0]->getUserRole->id]);
    }

    //Change User Status
    public function changeUserStatus(Request $req)
    {
        $aid = $req->aid;
        $check = $req->check;

        $aData = User::find($aid);
        $aData->status = $check;
        $aData->save();

        return response()->json($aData);
    }

    //Edit User
    public function editUser(Request $req)
    {
        $editContent = User::whereId($req->aid)->first();
        return response()->json($editContent);
    }

    //Validation part for editing User
    public function editUser_check(Request $req, UserRole $assetVar)
    {

        $rules = array(
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',

        );

        // $messages = array(
        //     'assetname.required' => 'Asset name is required',
        //     'assetname.string' => 'Invalid asset name',
        //     'assetname.unique' => 'Asset name already exists',
        // );

        $error = Validator::make($req->all(), $rules/* , $messages */);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'firstname' => $req->firstname,
            'lastname' => $req->lastname,
        );

        if (User::whereId($req->aid)->first()->firstname == session('sid'))
            $req->session()->put('sid', $req->firstname);

        User::whereId($req->aid)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    //Delete User
    public function delUser(Request $req)
    {
        $delContent = User::whereId($req->aid);
        $delContent->delete();
    }
}
