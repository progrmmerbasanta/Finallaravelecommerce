<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\cart;

use Illuminate\Support\Facades\Hash;

class CartController extends Controller
{

    public function delete($id){
        $cart=cart::find($id);
        $cart->delete();
        return response([
            'status'=>200,
            'message'=>'Deleted'
        ]);
    }
    public function cart_detailsEdit(Request $request, $id)
    {
        dd($request->all());
        $updateFields = ['name', 'price', 'img', 'quantity', 'isExist', 'time', 'product',];
        $toUpdate = [];
        foreach ($updateFields as $value) {
            if ($request->get($value) != null) {
                $toUpdate[$value] = $request->get($value);
            }
        }

        cart::where('id', $id)->update($toUpdate);
        return ["Success" => true];
    }
    public function deletecart_details(Request $request, $id)
    {
        cart::where('id', $id)->delete();
        return ["Success" => true];
    }
    public function addcart_details(Request $request)
    {
        $optionalField = [];
        $mustHave = ['name', 'price', 'img', 'quantity', 'isExist', 'time', 'product',];
        $toValidate = [];
        $toStore = [];
        for ($i = 0; $i < count($mustHave); $i++) {
            $toValidate[$mustHave[$i]] = ['required'];
            $toStore[$mustHave[$i]] = $request->get($mustHave[$i]);
        }
        for ($i = 0; $i < count($optionalField); $i++) {
            $toStore[$optionalField[$i]] = $request->get($optionalField[$i]);
        }


        cart::insert($toStore);
        return ["Success" => true];
    }
    public function cart_details(Request $request)
    {
        $data =  cart::select('id', 'name', 'price', 'img', 'quantity', 'isExist', 'time', 'product')->get();
        return $data;
    }
    //
}
