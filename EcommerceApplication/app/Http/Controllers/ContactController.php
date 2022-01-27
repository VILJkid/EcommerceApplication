<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //Display Contact Us messages
    public function showContactUs(Request $request)
    {
        $aData = Contact::latest('updated_at')->paginate(4);
        return view("AdminPanel.Pages.showContactUs", ['aData' => $aData]);
        // return response()->json(['dasj', $aData[0]->getUser]);
    }
}
