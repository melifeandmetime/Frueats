<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller
{
    public function insert_cart(Request $request)
    {
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');

        $product = DB::table('products')->where('id', $product_id)->first();

        $existingCart = DB::table('cart')->where('id_user', Auth::user()->id)
                             ->where('product_id', $product_id)
                             ->first();

        if ($existingCart) {

            // Increment the quantity by qty
            $qty_update = $existingCart->qty += $qty;

            DB::table('cart')->where('id_user', Auth::user()->id)
                    ->where('product_id', $product_id)
                    ->update([
                        'qty' => $qty_update,
                        'total' => $qty_update * $existingCart->price
                    ]);

            $list_cart = DB::table('cart')
                        ->select('cart.*','products.name as name_product')
                        ->join('products','products.id','=','cart.product_id')
                        ->where('id_user', Auth::user()->id)
                        ->get();

            return response()->json([
                'status' => 'success update cart',
                'data' => $list_cart
            ]);
        }

        DB::table('cart')
        ->insert([
            'id_user' => Auth::user()->id,
            'qty' => $qty,
            'product_id' => $product_id,
            'price' => $product->price,
            'total' => $product->price,
        ]);

        $list_cart = DB::table('cart')
                    ->select('cart.*','products.name as name_product')
                    ->join('products','products.id','=','cart.product_id')
                    ->where('id_user', Auth::user()->id)
                    ->get();

        return response()->json([
            'status' => 'success insert cart',
            'data' => $list_cart
        ]);
    }

    public function list_cart()
    {
        $list_cart = DB::table('cart')
                    ->select('cart.*','products.name as name_product')
                    ->join('products','products.id','=','cart.product_id')
                    ->where('id_user', Auth::user()->id)
                    ->get();

        return response()->json([
            'status' => 'success view cart',
            'data' => $list_cart
        ]);
    }
}
