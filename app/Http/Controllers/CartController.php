<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ListCart;
use App\Models\OrderHeader;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $carts = \Cart::getContent();
        $cartCount = \Cart::getContent()->count();
        $cartTotal = \Cart::getTotal();
        $list_cart = ListCart::where('id_user', Auth::user()->id)->get();

        return view('frontend.cart.index', compact('list_cart','cartCount','cartTotal'));
    }

    public function insertCart($id)
    {
        $product = Product::find($id);

        $existingCart = ListCart::where('id_user', Auth::user()->id)
                             ->where('product_id', $id)
                             ->first();

        if ($existingCart) {

            // Increment the quantity by 1
            $existingCart->qty += 1;
            // Recalculate the total price
            $existingCart->total = $existingCart->qty * $existingCart->price;
            // Save the changes
            $existingCart->save();

            $carts = \Cart::getContent();
            $cartCount = \Cart::getContent()->count();
            $cartTotal = \Cart::getTotal();
            $list_cart = ListCart::with('products')->where('id_user', Auth::user()->id)->get();

            return redirect('carts');
        }

        $cart = new ListCart();
        $cart->id_user = Auth::user()->id;
        $cart->product_id = $id;
        $cart->qty = 1;
        $cart->price = $product->price;
        $cart->total = $product->price;
        $cart->save();

        $carts = \Cart::getContent();
        $cartCount = \Cart::getContent()->count();
        $cartTotal = \Cart::getTotal();
        $list_cart = ListCart::with('products')->where('id_user', Auth::user()->id)->get();

        return redirect('carts');
    }

    public function deleteCart($id)
    {
        ListCart::where('id',$id)->delete();

        return redirect()->back();
    }

    public function updateCart(Request $request, $id)
    {
        $cartItem = ListCart::where('id', $id)
                             ->where('id_user', Auth::user()->id)
                             ->first();

        if ($cartItem) {
            $cartItem->qty = $request->qty;
            $cartItem->total = $cartItem->qty * $cartItem->price;
            $cartItem->save();

            // Calculate new total price for all cart items
            $total = ListCart::where('id_user', Auth::user()->id)->sum('total');

            return response()->json([
                'status' => 'success',
                'total' => number_format($total, 2),
                'subtotal' => number_format($cartItem->total, 2),
            ]);
        }

        return response()->json(['status' => 'error'], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$sessionKey = null)
    {
        $product = Product::findOrFail($request->productId);

		$item = [
			'id' => md5($product->id),
			'name' => $product->name,
			'price' => $product->price,
			'quantity' => isset($request->quantity) ? $request->quantity : 1,
			'associatedModel' => $product,
		];

        if ($sessionKey) {
            \Cart::add($item);
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Added to Cart !',
            ]);
        }else {
            $carts = \Cart::add($item);
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Added to Cart !',
            ]);
        }
        
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCart(Request $request)
    {
        $carts = \Cart::getContent();
        $cart_total = \Cart::getTotal();

        return response()->json([
            'status' => 200,
            'carts' => $carts,
            'cart_total' => $cart_total,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cart_id)
    {
        $cartUpdate = \Cart::update($cart_id,[
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity,
            ],
        ]);

        $carts = \Cart::getContent();
        $cart_total = \Cart::getTotal();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully updated Cart !',
            'carts' => $carts,
            'cart_total' => $cart_total,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart_id)
    {
        \Cart::remove($cart_id);
        $cart_total = \Cart::getTotal();

        return response()->json([
            'status' => 200,
            'message' => 'Successfully deleted Cart !',
            'cart_total' => $cart_total,
        ]);
    }
}
