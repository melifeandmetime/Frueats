<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\OrderHeader;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'payment_file' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'province' => 'required',
            'city' => 'required',
            'shipping_cost' => 'required',
            'payment_method' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $invoiceCode = $this->generateInvoiceCode();
        $subtotal = DB::table('cart')->where('id_user', Auth::user()->id)->sum('total');

        if ($request->hasFile('payment_file')) {
            $imagePath = $request->file('payment_file')->store('payment', 'public');
        }

        $order_id =  DB::table('order_header')->insertGetId([
            'id_user'       => Auth::user()->id,
            'code'          => $invoiceCode,
            'status'        => 'proses',
            'payment_file'  => $imagePath,
            'address'       => $request->input('address'),
            'province'      => $request->input('province'),
            'city'          => $request->input('city'),
            'shipping'      => $request->input('shipping_cost'),
            'tipe'          => $request->input('payment_method'),
            'total'         => $subtotal + $request->input('shipping_cost'),
        ]);

        // Retrieve all cart items for the user
        $cartItems = DB::table('cart')->where('id_user', Auth::user()->id)->get();

        // Insert cart items into order details
        foreach ($cartItems as $cartItem) {
            DB::table('order_detail')->insert([
                'code'          => $invoiceCode,
                'order_id'      => $order_id,
                'product_id'    => $cartItem->product_id,
                'qty'           => $cartItem->qty,
                'price'         => $cartItem->price,
                'total'         => $cartItem->total,
            ]);
        }

        //hapus cart
        DB::table('cart')->where('id_user', Auth::user()->id)->delete();

        return response()->json([
            'status' => 'success payment',
            'data' => $invoiceCode
        ]);
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

    public function history(Request $request)
    {
        $code = $request->input('code');

        $query = DB::table('order_header')
                ->where('id_user', Auth::user()->id);

        if ($code) {
            $query->where('order_header.code', $code);
        }
                
        $order = $query->orderBy('order_header.code','asc')->get();

        foreach($order as $raw){
            $order_detail = DB::table('order_detail')
                            ->select('order_detail.*','products.name as name_product')
                            ->join('products','products.id','=','order_detail.product_id')
                            ->where('order_id', $raw->id)
                            ->get();

            $raw->detail_order = $order_detail;
        }

        return response()->json([
            'status' => 'success view history',
            'data' => $order
        ]);
    }
}
