<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ListCart;
use App\Models\OrderHeader;
use App\Models\OrderDetail;
use Auth;
use Carbon\Carbon;

class OrderShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderPayment()
    {        
        $carts = \Cart::getContent();
        $cartCount = \Cart::getContent()->count();
        $cartTotal = \Cart::getTotal();
        $subtotal = ListCart::where('id_user', Auth::user()->id)->sum('total');

        return view('frontend.order.checkout', compact('subtotal','cartCount','cartTotal'));
    }

    public function orderStore(Request $request)
    {
        $invoiceCode = $this->generateInvoiceCode();
        $subtotal = ListCart::where('id_user', Auth::user()->id)->sum('total');

        $order = new OrderHeader();
        $order->id_user = Auth::user()->id;
        $order->code = $invoiceCode;
        $order->status = 'proses';

        if ($request->hasFile('payment_file')) {
            $imagePath = $request->file('payment_file')->store('payment', 'public');
            $order->payment_file = $imagePath;
        }

        $order->address = $request->address;
        $order->province = $request->province;
        $order->city = $request->city;
        $order->shipping = $request->shipping_cost;
        $order->tipe = $request->payment_method;
        $order->total = $subtotal + $request->shipping_cost;
        $order->save();

        // Retrieve all cart items for the user
        $cartItems = ListCart::where('id_user', Auth::user()->id)->get();

        // Insert cart items into order details
        foreach ($cartItems as $cartItem) {
            $orderDetail = new OrderDetail();
            $orderDetail->code = $invoiceCode;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cartItem->product_id;
            $orderDetail->qty = $cartItem->qty;
            $orderDetail->price = $cartItem->price;
            $orderDetail->total = $cartItem->total;
            $orderDetail->save();
        }
            //hapus cart
        ListCart::where('id_user', Auth::user()->id)->delete();

        return redirect('order_confirm');
    }

    public function orderConfirm()
    {
        $carts = \Cart::getContent();
        $cartCount = \Cart::getContent()->count();
        $cartTotal = \Cart::getTotal();

        return view('frontend.order.confirm', compact('cartCount','cartTotal','carts'));
    }

    public function generateInvoiceCode()
    {
        // Define the prefix for the invoice code
        $prefix = 'INV';

        // Get the current date in the format YYYYMMDD
        $date = Carbon::today()->format('Ymd');

        // Get the latest order's invoice code for today, if any
        $latestOrder = OrderHeader::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

        if ($latestOrder) {
            // Extract the number from the latest invoice code and increment it
            $latestInvoiceNumber = substr($latestOrder->code, -4); // Change 'invoice_code' to 'code'
            $newInvoiceNumber = str_pad(intval($latestInvoiceNumber) + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Start with 0001 if no orders exist for today
            $newInvoiceNumber = '0001';
        }

        // Combine prefix, date, and new invoice number to create the new invoice code
        $newInvoiceCode = $prefix . $date . $newInvoiceNumber;

        return $newInvoiceCode;
    }

}
