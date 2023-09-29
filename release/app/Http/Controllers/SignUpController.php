<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\signp;

use Illuminate\Support\Facades\Hash;
 class SignUpController extends Controller 
{
public function deletesignup(Request $request, $id){
    signp::where('id', $id)->delete();
    return ["Success" => true];
}
public function addsignup(Request $request) { 
    $optionalField = [];
    $mustHave = ['id', 'f_name', 'f_phone', 'f_email', 'f_password', ];
    $toValidate = [];
    $toStore = [];
    for($i = 0; $i < count($mustHave); $i++){
        $toValidate[$mustHave[$i]] = ['required'];
        $toStore[$mustHave[$i]] = $request->get($mustHave[$i]);
    }
    for($i = 0; $i < count($optionalField); $i++){
        $toStore[$optionalField[$i]] = $request->get($optionalField[$i]);
    }
    
    
    signp::insert($toStore);
    return ["Success" => true]; 
}
public function signupEdit(Request $request, $id)
{
    $updateFields = ['id', 'f_name', 'f_phone', 'f_email', 'f_password', ];
    $toUpdate = [];
    foreach($updateFields as $value){
        if($request->get($value) != null){
            $toUpdate[$value] = $request->get($value);
        }
    }
    
    signp::where('id', $id)->update($toUpdate);
    return ["Success" => true]; 
}
public function viewsignup(Request $request){
    $data =  signp::select('id', 'f_name', 'f_phone', 'f_email', 'f_password')->get();
    return $data;
}
    //
}
