<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use App\Models\CommodityCategory;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get data
        $orders = Order::when(request()->q, function ($orders) {
            $orders = $orders->where('name', 'like', '%' . request()->q . '%');
        })->with('user', 'commodity')->latest()->paginate(10);

        // append query string to pagination links
        $orders->appends(request()->all());

        // data users
        $users = User::all();

        // render with inertia
        return Inertia::render('Admin/Orders/Index', [
            'orders' => $orders,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $warehouses = Warehouse::all();
        $categories = CommodityCategory::all();
        $commodities = Commodity::all();

        return Inertia::render('Admin/Orders/Create', [
            'users' => $users,
            'warehouses' => $warehouses,
            'categories' => $categories,
            'commodities' => $commodities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     // on orders
        //     'user_id' => 'required',
        //     'invoice_number' => 'required',
        //     'date' => 'required',
        //     'type' => 'required',
        //     'status' => 'required',
        //     'total_commodities' => 'required',
        //     'sub_total' => 'required',
        //     // on order details
        //     'order_id' => 'required',
        //     'commodity_id' => 'required',
        //     'quantity' => 'required',
        //     'unit_price' => 'required',
        //     'total' => 'required',
        // ], [
        //     'user_id.required' => 'The user field is required.',
        //     'invoice_number.required' => 'The invoice number field is required.',
        //     'date.required' => 'The date field is required.',
        //     'type.required' => 'The type field is required.',
        //     'status.required' => 'The status field is required.',
        //     'total_commodities.required' => 'The total commodities field is required.',
        //     'sub_total.required' => 'The sub total field is required.',
        //     'order_id.required' => 'The order id field is required.',
        //     'commodity_id.required' => 'The commodity id field is required.',
        //     'quantity.required' => 'The quantity field is required.',
        //     'unit_price.required' => 'The unit price field is required.',
        //     'total.required' => 'The total field is required.',
        // ]);

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'invoice_number' => 1,
            'date' => date('Y-m-d'),
            'type' => 'Order',
            'status' => 'Pending',
            'total_commodities' => $request->total_commodities,
            'sub_total' => $request->sub_total,
        ]);

        // Loop through the commodities and associate them with the order
        foreach ($request->commodities as $commodity) {
            OrderDetail::create([
                'order_id' => $order->id,
                'commodity_id' => $commodity['commodity_id'],
                'quantity' => $commodity['quantity'],
                'unit_price' => $commodity['unit_price'],
                'total' => $commodity['total'],
            ]);

            // reduce stock
            Commodity::find($commodity['commodity_id'])->update([
                'stock' => Commodity::find($commodity['commodity_id'])->stock - $commodity['quantity'],
            ]);
        }

        return to_route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order = Order::with('user')->find($order->id);

        $detail = OrderDetail::with('commodity')->where('order_id', $order->id)->get();

        return Inertia::render('Admin/Orders/Detail', [
            'order' => $order,
            'detail' => $detail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // cek order detail berdasarkan order_id
        $order_details = OrderDetail::where('order_id', $order->id)->get();

        foreach ($order_details as $order_detail) {
            Commodity::find($order_detail->commodity_id)->update([
                'stock' => Commodity::find($order_detail->commodity_id)->stock + $order_detail->quantity,
            ]);
        }

        $order->forceDelete();

        return to_route('orders.index');
    }
}