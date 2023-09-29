<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('viewsignup', 'App\Http\Controllers\SignUpController@viewsignup');

Route::post('addsignup', 'App\Http\Controllers\SignUpController@addsignup');

Route::patch('signupEdit/{id}', 'App\Http\Controllers\SignUpController@signupEdit');

Route::delete('deletesignup/{id}', 'App\Http\Controllers\SignUpController@deletesignup');

Route::get('viewuser', 'App\Http\Controllers\UserController@viewuser');

Route::post('adduser', 'App\Http\Controllers\UserController@adduser');

Route::patch('userEdit/{id}', 'App\Http\Controllers\UserController@userEdit');

Route::delete('deleteuser/{id}', 'App\Http\Controllers\UserController@deleteuser');

Route::get('cart_details', 'App\Http\Controllers\CartController@cart_details');

Route::post('addcart_details', 'App\Http\Controllers\CartController@addcart_details');

Route::patch('cart_detailsEdit/{id}', 'App\Http\Controllers\CartController@cart_detailsEdit');

Route::delete('deletecart_details/{id}', 'App\Http\Controllers\CartController@deletecart_details');

Route::get('viewproducts_details', 'App\Http\Controllers\ProductsController@viewproduct_details');

Route::post('addproducts_details', 'App\Http\Controllers\ProductsController@addproducts_details');

Route::patch('products_detailsEdit/{id}', 'App\Http\Controllers\ProductsController@products_detailsEdit');

Route::delete('deleteproducts_details/{id}', 'App\Http\Controllers\ProductsController@deleteproducts_details');

Route::get('viewsignup', 'App\Http\Controllers\SignUpController@viewsignup');

Route::post('addsignup', 'App\Http\Controllers\SignUpController@addsignup');

Route::patch('signupEdit/{id}', 'App\Http\Controllers\SignUpController@signupEdit');

Route::delete('deletesignup/{id}', 'App\Http\Controllers\SignUpController@deletesignup');

Route::get('viewuser', 'App\Http\Controllers\UserController@viewuser');

Route::post('adduser', 'App\Http\Controllers\UserController@adduser');

Route::patch('userEdit/{id}', 'App\Http\Controllers\UserController@userEdit');

Route::delete('deleteuser/{id}', 'App\Http\Controllers\UserController@deleteuser');

Route::get('cart_details', 'App\Http\Controllers\CartController@cart_details');

Route::post('addcart_details', 'App\Http\Controllers\CartController@addcart_details');

Route::patch('cart_detailsEdit/{id}', 'App\Http\Controllers\CartController@cart_detailsEdit');

Route::delete('deletecart_details/{id}', 'App\Http\Controllers\CartController@deletecart_details');

Route::get('order_details', 'App\Http\Controllers\OrderController@order_details');

// Route::post('addorder_details', 'App\Http\Controllers\OrderController@addorder_details');

Route::patch('order_detailsEdit/{id}', 'App\Http\Controllers\OrderController@order_detailsEdit');

Route::delete('deleteorder_details/{id}', 'App\Http\Controllers\OrderController@deleteorder_details');

Route::get('viewproducts_details', 'App\Http\Controllers\ProductsController@viewproduct_details');

Route::post('addproducts_details', 'App\Http\Controllers\ProductsController@addproducts_details');

Route::patch('products_detailsEdit/{id}', 'App\Http\Controllers\ProductsController@products_detailsEdit');

Route::delete('deleteproducts_details/{id}', 'App\Http\Controllers\ProductsController@deleteproducts_details');


// apis
// api for login
Route::post('/login', [UserController::class, 'userlogin']);
// api for register
Route::post('/register', [UserController::class, 'register']);

// apis with login required
Route::group(['middleware' => ['auth:sanctum']], function () {
    // api for create order
    Route::post('create-order', [OrderController::class, 'addorder_details']);
    // get individual user order
    Route::get("individualUserOrders",  [OrderController::class, 'showIndividualUserOrders']);
    // top selling products apis
    Route::get("/topSellingProduct", [ProductsController::class, "topselling"]);
    // product rating
    Route::post('create-rating', [RatingController::class, 'store']);

    // delete cart 
    Route::get('delete-cart-item/{id}', [CartController::class, 'delete']);

    
});
Route::get("/recommended", [ProductsController::class, "recommend"]);
