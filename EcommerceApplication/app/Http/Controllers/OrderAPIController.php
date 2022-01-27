<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductAttributesAssoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Casts\ArrayObject;

class OrderAPIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['placeOrder', 'getOrders']]);
    }

    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_address' => 'required|string',
            'order_note' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {

            $order = new Order();
            // $user->user_id = $request->user()->id;
            $order->order_address = $request->order_address;
            $order->order_note = $request->order_note;
            $order->order_amount = $request->order_amount;
            $order->user_id = $request->user_id;
            if ($order->save()) {

                foreach ($request->products as $product) {
                    $orderProduct = new OrderProduct();
                    $orderProduct->order_id = $order->id;
                    $orderProduct->product_id = $product["pid"];
                    $orderProduct->product_qty = $product["quantity"];
                    if ($orderProduct->save()) {

                        $productData = ProductAttributesAssoc::where('product_id', $product["pid"])->first();
                        $newProductQty = $productData->product_qty_max - $product["quantity"];
                        $form_data = array(
                            'product_qty_max' => $newProductQty,
                        );
                        $productData->update($form_data);

                        $flag1 = 1;
                    } else {
                        return response(['msg' => 'Data not added'], 401);
                    }
                }

                if ($flag1 == 1) {

                    $coupon = Coupon::where('coupon_value', $request->coupon_value)->first();
                    $oldCouponQty = $coupon->coupon_qty;
                    $coupon->update(['coupon_qty' => $oldCouponQty - 1]);

                    return response(['data' => ($order), "Message" => "Order placed sucessfully"], 201);
                } else {
                    return response(['msg' => 'Data not added'], 401);
                }
            } else {
                return response(['msg' => 'Data not added'], 401);
            }
        }
    }

    public function getOrders(Request $request)
    {
        $orders = Order::with('getOrderProducts.getProduct')->where('user_id', $request->user_id)->get();
        return response()->json(['orders' => $orders], 200);
    }
}
