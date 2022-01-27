<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductAttributesAssoc;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Casts\ArrayObject;

class ProductAPIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllCategory', 'getCategoryName', 'getAllProduct', 'getAllProductAssoc', 'getProduct', 'getProductAssoc', 'getAllProductAssocDefault', 'getAllProductDefault', 'getProductImage', 'getAllCoupons']]);
    }

    public function getAllCategory()
    {
        // $creds = $req->only(['email', 'password']);
        $categories = Category::orderBy('category_name')->get();

        return response()->json(['categories' => $categories], 200);
        // return response()->json(['token' => $token]);
    }

    public function getCategoryName($category_id)
    {
        $category_name = Category::find($category_id)->category_name;

        return response()->json(['categoryName' => $category_name], 200);
    }

    public function getAllProduct(Request $request)
    {
        $products = Product::where('category_id', $request->category_id)->get();

        return response()->json(['products' => $products], 200);
    }

    public function getAllProductAssoc(Request $request)
    {
        $productAssocs = new ArrayObject(array());
        $products = Product::where('category_id', $request->category_id)->get();

        foreach ($products as $product) {
            $temp = ProductAttributesAssoc::where('product_id', $product->id)->get();

            $productAssocs->append($temp[0]);
        }

        return response()->json(['productAssocs' => $productAssocs], 200);
    }

    public function getProduct(Request $request)
    {
        $product = Product::with('getProductAttributesAssoc')->whereId($request->product_id)->get();

        return response()->json(['product' => $product], 200);
    }

    public function getProductAssoc(Request $request)
    {
        $productAssoc = ProductAttributesAssoc::where('product_id', $request->product_id)->get();

        return response()->json(['productAssoc' => $productAssoc], 200);
    }

    public function getProductImage(Request $request)
    {
        $productImage = ProductImage::where('product_id', $request->product_id)->get();

        return response()->json(['productImage' => $productImage], 200);
    }

    public function getAllProductAssocDefault()
    {
        // $creds = $req->only(['email', 'password']);
        $productAssocs = ProductAttributesAssoc::orderBy('brand')->get();

        return response()->json(['productAssocs' => $productAssocs], 200);
        // return response()->json(['token' => $token]);
    }

    public function getAllProductDefault()
    {
        // $creds = $req->only(['email', 'password']);
        $products = Product::with('getProductAttributesAssoc')->orderBy('product_name')->get();

        return response()->json(['products' => $products], 200);
        // return response()->json(['token' => $token]);
    }

    public function getAllCoupons()
    {
        $coupons = Coupon::orderBy('coupon_name')->get();
        return response()->json(['coupons' => $coupons], 200);
    }
}
