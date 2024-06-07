<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;

class ProductController extends Controller
{
    public function list_product(Request $request)
    {
        $category = $request->input('category');

        $query = DB::table('products')
                ->select('products.*')
                ->join('categories','categories.id','=','products.category_id');

        if ($category) {
            $query->where('categories.slug', $category);
        }

        $products = $query->orderBy('products.name', 'asc')->get();

        foreach ($products as $product) {
            $product->image = asset('storage/' . $product->image);
        }

        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }
}
