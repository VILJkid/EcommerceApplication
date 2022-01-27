<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\OrderAPIController;
use App\Http\Controllers\ProductAPIController;
use App\Http\Controllers\ContactAPIController;
use App\Http\Controllers\CMSAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('User', UserController::class);

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('user/register', [APIController::class, 'register']);
    Route::post('user/login', [APIController::class, 'login']);
    Route::post('user/logout', [APIController::class, 'logout']);
    Route::post('user/updatepassword', [APIController::class, 'updatePassword']);
    // Route::post('/refresh', [APIController::class, 'refresh']);
    Route::post('user/profile', [APIController::class, 'profile']);
});

Route::group(['middleware' => 'api'], function ($router) {
    Route::get('frontend/allCategory', [ProductAPIController::class, 'getAllCategory']);
    Route::get('frontend/categoryName/{category_id}', [ProductAPIController::class, 'getCategoryName']);
    Route::post('frontend/product', [ProductAPIController::class, 'getProduct']);
    Route::get('frontend/allProductDefault', [ProductAPIController::class, 'getAllProductDefault']);
    Route::post('frontend/allProduct', [ProductAPIController::class, 'getAllProduct']);
    Route::post('frontend/productAssoc', [ProductAPIController::class, 'getProductAssoc']);
    Route::get('frontend/allProductAssocDefault', [ProductAPIController::class, 'getAllProductAssocDefault']);
    Route::post('frontend/allProductAssoc', [ProductAPIController::class, 'getAllProductAssoc']);
    Route::post('frontend/productImage', [ProductAPIController::class, 'getProductImage']);

    Route::get('frontend/allCoupons', [ProductAPIController::class, 'getAllCoupons']);
});

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('order/placeorder', [OrderAPIController::class, 'placeOrder']);
    Route::post('order/getorders', [OrderAPIController::class, 'getOrders']);
});

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('contact/contactus', [ContactAPIController::class, 'contactUs']);
});

Route::group(['middleware' => 'api'], function ($router) {
    Route::get('cms/getcms', [CMSAPIController::class, 'getCMS']);
});

// Route::post('/login', [
//     'as' => 'login.login',
//     'uses' => 'APIController@login'
// ]);
