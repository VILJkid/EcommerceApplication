<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Auth extends Controller
{
    // Login page
    public function login()
    {
        return view("AdminPanel.Pages.login");
    }

    //Validation part for Login
    public function login_check(Request $req)
    {
        $validatedData = $req->validate([
            'email' => 'required|regex:/^[a-zA-Z][a-zA-Z0-9_]+[@][a-zA-Z]+[.][a-zA-Z]+$/',
            'password' => 'required|min:6|max:50',
        ], [
            'email.required' => 'Email is required',
            'email.regex' => 'Invalid email',
            'password.required' => 'Password is required',
            'password.min' => 'Min 5',
            'password.max' => 'Min 50',
        ]);
        if ($validatedData) {
            $email = $req->email;
            $pass = $req->password;

            $email_exists = User::where('email', $email)->first();
            if (empty($email_exists))
                return back()->with('error', "Email not registered");

            if (!Hash::check($pass, $email_exists->password))
                return back()->with('error', "Incorect passsword");

            if ($email_exists->role_id == 5)
                return back()->with('error', "You don't the have required perms");

            $req->session()->put('sid', $email_exists->firstname);

            return redirect("/dashboard");
            // return back()->with('success', "Tada");
        }
    }

    //Logout
    public function logout()
    {
        session()->forget('sid');
        return redirect("/login");
    }


    // Dashboard
    public function dashboard()
    {
        return view("AdminPanel.Pages.dashboard");
    }


    // Fetching the reports to dashboard
    public function getstats(Request $req)
    {
        $data1 = Category::get();
        $data2 = Order::with('getOrderProducts.getProduct.getCategory')->get();
        $data3 = Coupon::get();
        $data4 = User::where('role_id', '5')->get();

        return response()->json(["data1" => $data1, "data2" => $data2, "data3" => $data3, "data4" => $data4]);
    }
}
