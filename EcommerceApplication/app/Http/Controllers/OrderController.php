<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //Display Orders
    public function showOrders(Request $request)
    {
        $aData = Order::latest('updated_at')->paginate(4);
        return view("AdminPanel.Pages.showOrders", ['aData' => $aData]);
        // return response()->json(['dasj', $aData[0]->getUser]);
    }
}
