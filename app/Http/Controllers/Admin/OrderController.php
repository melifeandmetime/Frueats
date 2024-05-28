<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUploadingTrait;
use App\Models\Category;
use App\Models\Product;
use App\Models\ListCart;
use App\Models\OrderHeader;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ImageUploadingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = OrderHeader::with('customer')->get();

        return view('admin.order.index', compact('order'));
    }

    public function updateStatus($id)
    {
        $update = OrderHeader::where('id', $id)->update(['status' => 'completed']);

        return redirect()->back()->with([
            'message' => 'Success Update Status !',
            'type' => 'danger'
        ]);
    }

    public function show($id)
    {
        $header = OrderHeader::with('customer')->where('id', $id)->first();
        $detail = OrderDetail::with('products')->where('order_id', $id)->get();

        return view('admin.order.show', compact('header','detail'));
    }

    public function destroy(Request $request, $id)
    {
        OrderHeader::where('id', $id)->delete();
        OrderDetail::where('order_id', $id)->delete();

        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'type' => 'danger'
        ]);
    }

}
