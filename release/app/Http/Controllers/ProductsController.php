<?php

/**
 *  
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductsController extends Controller
{
    public function index()
    {
        $products = products::all();
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        return view('admin.products.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $image = $request->file('image');

        $product_image = $request->file('image')->getClientOriginalName();
        $data['img'] = $product_image;
        $result = products::create($data);
        if ($result) {
            $image->move('images/products', $product_image);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function show($id)
    {
        $product = products::where('id', $id)->first();
        return view('admin.products.show', compact('product'));
    }
    public function edit($id)
    {
        $product = products::where('id', $id)->first();
        return view('admin.products.edit', compact('product'));
    }
    public function update($id, Request $request)
    {
        $data = $request->all();
        $image = $request->file('image');
        $product_image = $request->file('image')->getClientOriginalName();
        $data['img'] = $product_image;
        $product = products::where('id', $id);
        $product->update(
            [
                'name' => $request->name,
                'price' => $request->price,
                'stars' => $request->stars,
                'img' => $product_image,
                'typeId' => $request->typeId,
                'description' => $request->description

            ]
        );
        $result = $product;
        if ($result) {
            $image->move(public_path('images/products'), $product_image);
            return redirect()->route('products');
        } else {
            return redirect()->back();
        }
    }
    public function delete($id)
    {
        products::where('id', $id)->delete();
        return redirect()->route('products');
    }
    public function deleteproducts_details(Request $request, $id)
    {
        products::where('id', $id)->delete();
        return ["Success" => true];
    }

    public function uploadFunction(Request $request)
    {
        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('img'), $imageName);
        return "http://" . request()->getHttpHost() . "/img/$imageName";
    }

    public function addproducts_details(Request $request)
    {
        $optionalField = [];
        $mustHave = ['name', 'price', 'description', 'stars', 'img',  'typeId',];
        $toValidate = [];
        $toStore = [];
        for ($i = 0; $i < count($mustHave); $i++) {
            $toValidate[$mustHave[$i]] = ['required'];
            $toStore[$mustHave[$i]] = $request->get($mustHave[$i]);
        }
        for ($i = 0; $i < count($optionalField); $i++) {
            $toStore[$optionalField[$i]] = $request->get($optionalField[$i]);
        }


        products::insert($toStore);
        return ["Success" => true];
    }

    public function products_detailsEdit(Request $request, $id)
    {
        $updateFields = ['name', 'description', 'stars', 'price', 'img',  'typeId',];
        $toUpdate = [];
        foreach ($updateFields as $value) {
            if ($request->get($value) != null) {
                $toUpdate[$value] = $request->get($value);
            }
        }

        products::where('id', $id)->update($toUpdate);
        return ["Success" => true];
    }

    public function viewproduct_details(Request $request)
    {
        $data =  products::select('id', 'name', 'price', 'description', 'stars', 'img',  'typeId')->get();
        return $data;
    }


    // api for topselling product
    public function topselling()
    {

        try {
            $topSellingProductIds = DB::table('order_products')
                ->join('products', 'order_products.product_id', '=', 'products.id')
                ->select('products.id')
                ->groupBy('products.id')
                ->orderByRaw('COUNT(order_products.product_id) DESC')
                ->take(10)
                ->pluck('id');

            // Now $topSellingProductIds contains the product IDs of the top 10 selling products.

            $topSellingProducts = products::whereIn('id', $topSellingProductIds)->get();
            return $topSellingProducts;
        } catch (\Exception $e) {
            // Handle any exceptions
            return $e->getMessage();
        }
    }

    public function recommend()
    {
        $recommendedProducts = DB::table('products')
            ->select('products.*', 'order_counts.total_sales', 'rating_avgs.avg_rating')
            ->leftJoinSub(function ($query) {
                $query->from('order_products')
                    ->select('product_id', DB::raw('COUNT(id) as total_sales'))
                    ->groupBy('product_id');
            }, 'order_counts', 'products.id', '=', 'order_counts.product_id')
            ->leftJoinSub(function ($query) {
                $query->from('ratings')
                    ->select('product_id', DB::raw('AVG(rating) as avg_rating'))
                    ->groupBy('product_id');
            }, 'rating_avgs', 'products.id', '=', 'rating_avgs.product_id')
            ->orderBy('price', 'asc')
            ->orderByDesc('total_sales')
            ->orderByDesc('avg_rating')
            ->take(10)
            ->get();

        return $recommendedProducts;
    }

    public function  destroy($id)
    {
        $product = products::find($id);
        $product->delete();
        return redirect()->back();
    }
}
