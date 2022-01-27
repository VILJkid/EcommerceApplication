<?php

namespace App\Http\Controllers;

use App\Models\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConfigurationController extends Controller
{
    public function showConstants(Request $request)
    {
        $aData = Constant::latest('updated_at')->paginate(4);
        return view("AdminPanel.Pages.showConstants", ['aData' => $aData]);
        // return response()->json(['dasj', $aData[0]->getUserRole->id]);
    }

    //Edit Asset
    public function editConstants(Request $req)
    {
        $editContent = Constant::whereId($req->aid)->first();
        return response()->json($editContent);
    }

    //Validation part for editing Asset Type
    public function editConstants_check(Request $req)
    {

        $rules = array(
            'admin_email' => 'required|email',
            'notification_email' => 'required|email',

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
            'admin_email' => $req->admin_email,
            'notification_email' => $req->notification_email,
        );

        Constant::whereId($req->aid)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }
}
