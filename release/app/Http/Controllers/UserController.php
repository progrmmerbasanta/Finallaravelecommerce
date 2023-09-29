<?php

namespace App\Http\Controllers;

use App\Models\frontuser;
use App\Models\order;
use App\Models\products;
use Illuminate\Http\Request;

use App\Models\user;
use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function deleteuser(Request $request, $id)
    {
        user::where('id', $id)->delete();
        return ["Success" => true];
    }
    public function index()
    {
        $users = user::all();
        foreach($users as $user){
            $order = order::where('user_id',$user->id);
            $user->order = $order->count();
        }
        return view('admin.users.index', compact('users'));
    }
    public function adduser(Request $request)
    {
        $optionalField = [];
        $mustHave = ['f_name', 'email', 'phone', 'order_count',];
        $toValidate = [];
        $toStore = [];
        for ($i = 0; $i < count($mustHave); $i++) {
            $toValidate[$mustHave[$i]] = ['required'];
            $toStore[$mustHave[$i]] = $request->get($mustHave[$i]);
        }
        for ($i = 0; $i < count($optionalField); $i++) {
            $toStore[$optionalField[$i]] = $request->get($optionalField[$i]);
        }


        user::insert($toStore);
        return ["Success" => true];
    }
    public function userEdit(Request $request, $id)
    {
        $updateFields = ['f_name', 'email', 'phone', 'order_count',];
        $toUpdate = [];
        foreach ($updateFields as $value) {
            if ($request->get($value) != null) {
                $toUpdate[$value] = $request->get($value);
            }
        }

        user::where('id', $id)->update($toUpdate);
        return ["Success" => true];
    }
    public function viewuser(Request $request)
    {
        $data =  user::select('id', 'f_name', 'email', 'phone', 'order_count')->get();
        return $data;
    }

    public function admin()
    {
        $orders  = order::all();
        $users = User::all();
        $products = products::all();
        $today = Carbon::now()->format('Y-m-d');
        $todaysOrder = order::whereDate('created_at', Carbon::today())->get();
        // dd(Carbon::today());
        
        $usersData = DB::table('users')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->get();
        $ordersData = DB::table('order')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->get();
        return view('admin.dashboard.index', compact('orders', 'users', 'products', 'todaysOrder', 'usersData', 'ordersData'));
    }


    // api for login
    function userlogin(Request $request)
    {
        try {
            $fields = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            //Check email
            $user = user::where('email', $fields['email'])->first();

            //Check Password
            if (!$user || !Hash::check($fields['password'], $user->password)) {
                return response([
                    'message' => 'Invalid Credentials'
                ], 401);
            }

            Auth::login($user);

            $token = $user->createToken('myapptoken')->plainTextToken;

            return response([
                'status' => 200,
                'user' => $user,
                'token' => $token,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // api for register 
    function register(Request $request)
    {
        try {
            $fields = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
                'name' => 'required',
                'confirm_password' => 'required'
            ]);

            $checkUserEmail = User::where('email', $request->email)->first();
            if ($checkUserEmail) {
                return response([
                    'status' => 402,
                    'message' => 'Email alread exists'
                ]);
            }

            if ($request->password !== $request->confirm_password) {
                return response([
                    'status' => 401,
                    'message' => "password didn't match"
                ]);
            }

            $user = new User();

            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->save();

            $token = $user->createToken('myapptoken')->plainTextToken;

            return response([
                'status' => 200,
                'message' => 'User created successfully',
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => 400,
                'message' => 'Error' . $th
            ]);
        }
    }
}
