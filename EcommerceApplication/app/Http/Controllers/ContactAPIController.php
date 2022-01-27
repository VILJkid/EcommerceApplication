<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactAPIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['contactUs']]);
    }

    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            $contact = new Contact();
            // $user->user_id = $request->user()->id;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            if ($contact->save()) {
                return response(['data' => ($contact), "Message" => "Message sent sucessfully"], 201);
            } else {
                return response(['msg' => 'Message not sent'], 401);
            }
        }
    }
}
