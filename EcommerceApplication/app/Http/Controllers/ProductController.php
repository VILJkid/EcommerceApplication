<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributesAssoc;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Add Product
    public function addProduct()
    {
        $atData = Category::orderBy('id')->get();
        return view("AdminPanel.Pages.addProduct", ['atData' => $atData]);
    }

    //Validation part for adding Product
    public function addProduct_check(Request $req)
    {
        $validatedData = $req->validate([
            'product_name' => 'required|string|unique:products',
            'product_desc' => 'required|string',
            'product_banner_image' => 'image|mimes:jpeg,png,jpg',
            'category_id' => 'required',

            'product_price' => 'required|integer',
            'product_qty_max' => 'required|integer',
            'brand' => 'required|string',
            'condition' => 'required',

            'product_image*' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($validatedData) {
            $product = new Product();
            $product->product_name = $req->product_name;
            $product->product_desc = $req->product_desc;
            $product->product_banner_image = $req->file('product_banner_image')->getClientOriginalName();
            $product->category_id = $req->category_id;

            if (!$req->product_banner_image->move(public_path('NeoStore/'), $req->file('product_banner_image')->getClientOriginalName())) {
                return back()->with('error', "Banner Image upload error");
            }

            if (!$product->save())
                return back()->with('error', "Product Database error");


            $productAttrib = new ProductAttributesAssoc();
            $productAttrib->product_price = $req->product_price;
            $productAttrib->product_qty_max = $req->product_qty_max;
            $productAttrib->brand = $req->brand;
            $productAttrib->condition = $req->condition;
            $productAttrib->product_id = Product::where('product_name', $req->product_name)->first()->id;

            if (!$productAttrib->save())
                return back()->with('error', "Product Attrib Database error");


            if ($req->hasFile('product_image')) {
                $product_ImageArr = [];
                foreach ($req->product_image as $file) {

                    $product_ImageName = $file->getClientOriginalName();
                    $product_ImageArr[] = $product_ImageName;

                    if (!$file->move(public_path('NeoStore/'), $product_ImageName)) {
                        return back()->with('error', "Product Images upload error");
                    }
                    $pimage = new ProductImage();
                    $pimage->product_image = $product_ImageName;
                    $pimage->product_id =
                        Product::where('product_name', $req->product_name)->first()->id;
                    if (!$pimage->save())
                        return back()->with('error', "Product Images Database error");
                }
            }

            return back()->with('success', "Product Added successfully");
        }
        // return response()->json(['dasj', $req->all()]);
    }

    //Display Products
    public function showProducts(Request $request)
    {
        $aData = Product::latest('updated_at')->paginate(4);
        return view("AdminPanel.Pages.showProducts", ['aData' => $aData]);
        // return response()->json(['dasj', $aData[0]->getProductAttributesAssoc->first()->id]);
    }

    //Edit Product
    public function editProduct(Request $req)
    {
        $editContent = Product::whereId($req->aid)->first();
        $editContentPA = ProductAttributesAssoc::where('product_id', $req->aid)->first();
        return response()->json([$editContent, $editContentPA]);
    }

    //Validation part for editing Product
    public function editProduct_check(Request $req)
    {

        $rules = array(
            'product_name' => 'required|string',
            'product_desc' => 'required|string',

            'product_price' => 'required|integer',
            'product_qty_max' => 'required|integer',
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

        $form_data1 = array(
            'product_name' => $req->product_name,
            'product_desc' => $req->product_desc,
        );

        $form_data2 = array(
            'product_price' => $req->product_price,
            'product_qty_max' => $req->product_qty_max,
        );

        Product::whereId($req->aid)->update($form_data1);
        ProductAttributesAssoc::where('product_id', $req->aid)->update($form_data2);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    //Display Banner
    public function showBanner(Request $req)
    {
        $aid = $req->aid;
        $aData = Product::where('id', $aid)->get();
        return response()->json(["aData" => $aData]);
    }

    //Display ProductImages
    public function showImages(Request $req)
    {
        $aid = $req->aid;
        $aData = Product::where('id', $aid)->get();
        $iData = ProductImage::where('product_id', $aid)->get();
        return response()->json(["aData" => $aData, "iData" => $iData]);
    }

    //Delete Product
    public function delProduct(Request $req)
    {
        $delContent = Product::whereId($req->aid);
        $delContent->delete();
    }
}
