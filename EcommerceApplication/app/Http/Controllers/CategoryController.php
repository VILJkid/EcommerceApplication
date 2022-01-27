<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Add Category
    public function addCategory()
    {
        $atData = Category::orderBy('id')->get();
        return view("AdminPanel.Pages.addCategory", ['atData' => $atData]);
    }

    //Validation part for adding Category
    public function addCategory_check(Request $req)
    {
        $validatedData = $req->validate([
            'category_name' => 'required|alpha|unique:categories',
        ]);

        if ($validatedData) {
            $category = new Category();
            // $user->user_id = $request->user()->id;
            $category->category_name = $req->category_name;
            if (!$category->save())
                return back()->with('error', "Category Database error");

            return back()->with('success', "Category Addedd successfully");
        }
        // return response()->json(['dasj', $req->all()]);
    }

    //Display Categories
    public function showCategories(Request $request)
    {
        $aData = Category::latest('updated_at')->paginate(4);
        return view("AdminPanel.Pages.showCategories", ['aData' => $aData]);
        // return response()->json(['dasj', $aData[0]->getUserRole->id]);
    }

    //Edit Category
    public function editCategory(Request $req)
    {
        $editContent = Category::whereId($req->aid)->first();
        return response()->json($editContent);
    }

    //Validation part for editing Category
    public function editCategory_check(Request $req)
    {

        $rules = array(
            'category_name' => 'required|alpha',

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
            'category_name' => $req->category_name,
        );

        Category::whereId($req->aid)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    //Delete Category
    public function delCategory(Request $req)
    {
        $delContent = Category::whereId($req->aid);
        $delContent->delete();
    }
}
