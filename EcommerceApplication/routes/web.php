<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Users;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\ActiveSession;
use App\Http\Middleware\RedirectToDash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//This will redirect logged in users to the dashboard.
Route::middleware([RedirectToDash::class])->group(
    function () {
        //Login
        Route::get('/login', [Auth::class, "login"]);

        //Validation part for Login
        Route::post('/login_check', [Auth::class, "login_check"]);
    }
);

//This will redirect guests to the login page.
Route::middleware([ActiveSession::class])->group(
    function () {

        //dooooooooo
        //Logout
        Route::get('/logout', [Auth::class, "logout"]);
        //Dashboard
        Route::get('/dashboard', [Auth::class, "dashboard"]);
        //Fetching the reports to dashboard
        Route::post('/getstats', [Auth::class, "getstats"]);

        //Creating User
        Route::get('/addUser', [Users::class, "addUser"]);
        //Validation part for adding User
        Route::post('/addUser_check', [Users::class, "addUser_check"]);
        //Displaying Users
        Route::get('/showUsers', [Users::class, "showUsers"]);
        //Delete User
        Route::delete('/delUser', [Users::class, "delUser"]);
        //Change User Status
        Route::post('/changeUserStatus', [Users::class, "changeUserStatus"]);
        //Editing User
        Route::post('/editUser', [Users::class, "editUser"]);
        //Validation part for editing Asset Type
        Route::post(
            '/editUser_check',
            [Users::class, "editUser_check"]
        );


        //Displaying Constants
        Route::get('/showConstants', [ConfigurationController::class, "showConstants"]);
        //Editing Constants
        Route::post('/editConstants', [ConfigurationController::class, "editConstants"]);
        //Validation part for editing Constants
        Route::post(
            '/editConstants_check',
            [Configuration::class, "editConstants_check"]
        );

        //Creating Category
        Route::get('/addCategory', [CategoryController::class, "addCategory"]);
        //Validation part for adding Category
        Route::post('/addCategory_check', [CategoryController::class, "addCategory_check"]);
        //Displaying Categories
        Route::get('/showCategories', [CategoryController::class, "showCategories"]);
        //Delete Category
        Route::delete('/delCategory', [CategoryController::class, "delCategory"]);
        //Editing Category
        Route::post('/editCategory', [CategoryController::class, "editCategory"]);
        //Validation part for editing Category
        Route::post(
            '/editCategory_check',
            [CategoryController::class, "editCategory_check"]
        );

        //Creating Product
        Route::get('/addProduct', [ProductController::class, "addProduct"]);
        //Validation part for adding Product
        Route::post('/addProduct_check', [ProductController::class, "addProduct_check"]);
        //Displaying Products
        Route::get('/showProducts', [ProductController::class, "showProducts"]);
        //Delete Product
        Route::delete('/delProduct', [ProductController::class, "delProduct"]);
        //Editing Product
        Route::post('/editProduct', [ProductController::class, "editProduct"]);
        //Validation part for editing Product
        Route::post(
            '/editProduct_check',
            [ProductController::class, "editProduct_check"]
        );
        //Display Banner
        Route::post('/showBanner', [ProductController::class, "showBanner"]);
        //Display Product Images
        Route::post('/showImages', [ProductController::class, "showImages"]);

        //Creating Coupon
        Route::get('/addCoupon', [CouponController::class, "addCoupon"]);
        //Validation part for adding Coupon
        Route::post('/addCoupon_check', [CouponController::class, "addCoupon_check"]);
        //Displaying Coupons
        Route::get('/showCoupons', [CouponController::class, "showCoupons"]);
        //Delete Coupon
        Route::delete('/delCoupon', [CouponController::class, "delCoupon"]);
        //Editing Coupon
        Route::post('/editCoupon', [CouponController::class, "editCoupon"]);
        //Validation part for editing Coupon
        Route::post(
            '/editCoupon_check',
            [CouponController::class, "editCoupon_check"]
        );

        //Displaying Orders
        Route::get('/showOrders', [OrderController::class, "showOrders"]);

        //Displaying Contact Us Messages
        Route::get('/showContactUs', [ContactController::class, "showContactUs"]);

        //Creating CMS
        Route::get('/addCMS', [CMSController::class, "addCMS"]);
        //Validation part for adding CMS
        Route::post('/addCMS_check', [CMSController::class, "addCMS_check"]);
        //Displaying CMS
        Route::get('/showCMS', [CMSController::class, "showCMS"]);
        //Delete CMS
        Route::delete('/delCMS', [CMSController::class, "delCMS"]);
        //Editing CMS
        Route::post('/editCMS', [CMSController::class, "editCMS"]);
        //Validation part for editing CMS
        Route::post(
            '/editCMS_check',
            [CMSController::class, "editCMS_check"]
        );
        //Display Image
        Route::post('/showImage', [CMSController::class, "showImage"]);
        //doooooooooooo

    }
);
