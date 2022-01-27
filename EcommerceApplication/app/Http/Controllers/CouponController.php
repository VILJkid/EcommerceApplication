<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    //Add Coupon
    public function addCoupon()
    {
        return view("AdminPanel.Pages.addCoupon");
    }

    //Validation part for adding Coupon
    public function addCoupon_check(Request $req)
    {
        $validatedData = $req->validate([
            'coupon_name' => 'required|alpha|unique:coupons',
            'coupon_value' => 'required|integer',
            'coupon_qty' => 'required|integer'
        ]);

        if ($validatedData) {

            $coupon = new Coupon();
            $coupon->coupon_name = $req->coupon_name;
            $coupon->coupon_code = strtoupper(bin2hex(random_bytes(10)));
            $coupon->coupon_value = $req->coupon_value;
            $coupon->coupon_qty = $req->coupon_qty;

            if (!$coupon->save())
                return back()->with('error', "Coupon Database error");

            return back()->with('success', "Coupon Addedd successfully");
        }
        // return response()->json(['dasj', $req->all()]);
    }

    //Display Coupons
    public function showCoupons(Request $request)
    {
        $aData = Coupon::latest('updated_at')->paginate(4);
        return view("AdminPanel.Pages.showCoupons", ['aData' => $aData]);
        // return response()->json(['dasj', $aData[0]->getProductAttributesAssoc->first()->id]);
    }

    //Edit Coupon
    public function editCoupon(Request $req)
    {
        $editContent = Coupon::whereId($req->aid)->first();
        return response()->json($editContent);
    }

    //Validation part for editing Coupon
    public function editCoupon_check(Request $req)
    {

        $rules = array(
            'coupon_name' => 'required|alpha',
            'coupon_value' => 'required|integer',
            'coupon_qty' => 'required|integer',
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
            'coupon_name' => $req->coupon_name,
            'coupon_value' => $req->coupon_value,
            'coupon_qty' => $req->coupon_qty,
        );

        Coupon::whereId($req->aid)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    //Delete Coupon
    public function delCoupon(Request $req)
    {
        $delContent = Coupon::whereId($req->aid);
        $delContent->delete();
    }
}
