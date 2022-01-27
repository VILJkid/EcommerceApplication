<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CMS;
use Illuminate\Support\Facades\Validator;

class CMSController extends Controller
{
    //Add CMS
    public function addCMS()
    {
        return view("AdminPanel.Pages.addCMS");
    }

    //Validation part for adding CMS
    public function addCMS_check(Request $req)
    {
        $validatedData = $req->validate([
            'cms_title' => 'required|string|unique:c_m_s',
            'cms_desc' => 'required|string',
            'cms_image' => 'image|mimes:jpeg,png,jpg',
            'cms_author' => 'required|alpha',
            'cms_url' => 'required|string',
        ]);

        if ($validatedData) {
            $cms = new CMS();
            $cms->cms_title = $req->cms_title;
            $cms->cms_desc = $req->cms_desc;
            $cms->cms_author = $req->cms_author;
            $cms->cms_url = $req->cms_url;
            $cms->cms_image = $req->file('cms_image')->getClientOriginalName();

            if (!$req->cms_image->move(public_path('NeoStore/'), $req->file('cms_image')->getClientOriginalName())) {
                return back()->with('error', "CMS Image upload error");
            }

            if (!$cms->save())
                return back()->with('error', "CMS Database error");

            return back()->with('success', "CMS Added successfully");
        }
        // return response()->json(['dasj', $req->all()]);
    }

    //Display CMS
    public function showCMS(Request $request)
    {
        $aData = CMS::latest('updated_at')->paginate(4);
        return view("AdminPanel.Pages.showCMS", ['aData' => $aData]);
        // return response()->json(['dasj', $aData[0]->getProductAttributesAssoc->first()->id]);
    }

    //Edit CMS
    public function editCMS(Request $req)
    {
        $editContent = CMS::whereId($req->aid)->first();
        return response()->json($editContent);
    }

    //Validation part for editing CMS
    public function editCMS_check(Request $req)
    {

        $rules = array(
            'cms_title' => 'required|string',
            'cms_desc' => 'required|string',
            'cms_author' => 'required|alpha',
            'cms_url' => 'required|string',
        );

        $error = Validator::make($req->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'cms_title' => $req->cms_title,
            'cms_desc' => $req->cms_desc,
            'cms_author' => $req->cms_author,
            'cms_url' => $req->cms_url,
        );

        CMS::whereId($req->aid)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    //Display Image
    public function showImage(Request $req)
    {
        $aid = $req->aid;
        $aData = CMS::where('id', $aid)->get();
        return response()->json(["aData" => $aData]);
    }

    //Delete CMS
    public function delCMS(Request $req)
    {
        $delContent = CMS::whereId($req->aid);
        $delContent->delete();
    }
}
