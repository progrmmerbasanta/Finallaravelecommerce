<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\order;
use App\Models\OrderProducts;
use App\Models\products;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order::all();
        return view('admin.order.index', compact('orders'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $result = order::create($data);
        if ($result) {
            return redirect()->route('order');
        } else {
            return redirect()->back();
        }
    }
    public function approve($id, Request $request)
    {
        $order = order::where('id', $id)->first();
        $order->fill(
            [
                'status' => $request->status
            ]
        );
        $order->save();
        return redirect()->route('order');
    }
    public function cancel($id, Request $request)
    {
        $order = order::where('id', $id)->first();
        $order->fill(
            [
                'status' => $request->status
            ]
        );
        $order->save();
        return redirect()->route('order');
    }
    public function delivered($id, Request $request)
    {
        $order = order::where('id', $id)->first();
        $order->fill(
            [
                'status' => $request->status
            ]
        );
        $order->save();
        return redirect()->route('order');
    }
    public function delete($id, Request $request)
    {
        $order = order::where('id', $id)->first();
        $order->delete();
        return redirect()->route('order');
    }

    public function deleteorder_details(Request $request, $id)
    {
        order::where('id', $id)->delete();
        return ["Success" => true];
    }
    public function addorder_details(Request $request)
    {
        // $optionalField = [];
        // $mustHave = ['name', 'price', 'img', 'quantity', 'isExist', 'time', 'status', 'product',];
        // $toValidate = [];
        // $toStore = [];
        // for ($i = 0; $i < count($mustHave); $i++) {
        //     $toValidate[$mustHave[$i]] = ['required'];
        //     $toStore[$mustHave[$i]] = $request->get($mustHave[$i]);
        // }
        // for ($i = 0; $i < count($optionalField); $i++) {
        //     $toStore[$optionalField[$i]] = $request->get($optionalField[$i]);
        // }


        // order::insert($toStore);
        // return ["Success" => true];
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                // 'product_id' => 'nullable|exists:products,id',
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                // 'img' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'time' => 'required|numeric',
                'isExist' => 'nullable|string|max:255',
                'product' => 'required',
                'status' => 'required|string|max:255',
            ]);



            // Create the order
            $order = new order();
            $order->user_id = 1;
            // $order->product_id = $request->input('product_id');
            $order->name = $request->input('name');
            $order->price = $request->input('price');
            // $order->img = $request->input('img');
            $order->quantity = $request->input('quantity');
            $order->time = $request->input('time');
            $order->isExist = $request->input('isExist');
            $order->product = $request->input('product');
            $order->status = $request->input('status');
            $order->save();

            foreach ($request->input('product') as $pro) {
                $ord = new OrderProducts();
                $ord->order_id = $order->id;
                $ord->product_id = $pro;
                $ord->save();
            }
            return response([
                'status' => 200,
                'message' => 'Sucessfully Ordered'
            ]);
        } catch (ValidationException $e) {
            // Validation failed
            return response([
                'status' => 500,
                'message' => 'Invalied Data'
            ]);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response([
                'status' => 500,
                'message' => 'Error' . $e
            ]);
        }
    }
    public function order_detailsEdit(Request $request, $id)
    {
        $updateFields = ['name', 'price', 'img', 'quantity', 'isExist', 'time', 'status', 'product',];
        $toUpdate = [];
        foreach ($updateFields as $value) {
            if ($request->get($value) != null) {
                $toUpdate[$value] = $request->get($value);
            }
        }

        order::where('id', $id)->update($toUpdate);
        return ["Success" => true];
    }
    public function order_details(Request $request)
    {
        $data =  order::select('id', 'name', 'price', 'img', 'quantity', 'isExist', 'time', 'product', 'status')->get();
        return $data;
    }


    // api for individual users order
    function showIndividualUserOrders()
    {
        try {
            $orders = order::where('user_id', auth()->user()->id)->get();

            foreach ($orders as $order) {
                $productDetails = [];
                foreach ($order->product as $productId) {
                    $product = products::find($productId);

                    if ($product) {
                        $productDetails[$productId] = [
                            $product
                        ];
                    }
                }
                $order->productDetails = $productDetails;
            }
            return response([
                'status' => 200,
                'data' => $orders,
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions
            return $e->getMessage();
        }
    }
}
