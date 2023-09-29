<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SigninController;
use App\Models\order;
use App\Models\products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [UserController::class,'admin'])->name('dashboard');
    Route::resource('products', ProductsController::class);

    //signin
    Route::middleware(['auth'])->group(function () {
        Route::post('/generate-token', [AuthController::class, 'generateToken']);
    });

    //order
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order-approve/{id}', [OrderController::class, 'approve'])->name('order.approve');
    Route::post('/order-cancel/{id}', [OrderController::class, 'cancel'])->name('order.cancel');
    Route::post('/order-delivered/{id}', [OrderController::class, 'delivered'])->name('order.delivered');

    Route::get('/order-delete/{id}', [OrderController::class, 'delete'])->name('order.delete');

});
