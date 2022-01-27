<?php

namespace App\Http\Controllers;

use App\Models\CMS;
use Illuminate\Http\Request;

class CMSAPIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getCMS']]);
    }

    public function getCMS(Request $request)
    {
        $cms = CMS::latest()->get();
        return response()->json(['cms' => $cms], 200);
    }
}
