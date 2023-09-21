<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Purchase;
use App\Models\Commodity;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\CommodityCategory;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // get data
        $purchases = Purchase::when(request()->q, function ($purchases) {
            $purchases = $purchases->where('name', 'like', '%' . request()->q . '%');
        })->with('user', 'commodity')->latest()->paginate(10);

        // append query string to pagination links
        $purchases->appends(request()->all());

        // data users
        $users = User::all();

        // render with inertia
        return Inertia::render('Admin/Purchases/Index', [
            'purchases' => $purchases,
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

        return Inertia::render('Admin/Purchases/Create', [
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
        $purchase = Purchase::create([
            'user_id' => Auth::user()->id,
            'supplier_id' => $request->supplier_id,
            'invoice_number' => 1,
            'date' => date('Y-m-d'),
            'type' => 'Order',
            'status' => 'Pending',
            'sub_total' => $request->sub_total,
            'total_commodities' => $request->total_commodities,
        ]);
        // Loop through the commodities and associate them with the order
        foreach ($request->commodities as $commodity) {
            OrderDetail::create([
                'purchase_id' => $purchase->id,
                'commodity_id' => $commodity['commodity_id'],
                'quantity' => $commodity['quantity'],
                'unit_price' => $commodity['unit_price'],
                'total' => $commodity['total'],
            ]);

            // add stock
            Commodity::find($commodity['commodity_id'])->update([
                'stock' => Commodity::find($commodity['commodity_id'])->stock + $commodity['quantity'],
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $purchase = Purchase::with('user')->find($purchase->id);

        $detail = PurchaseDetail::with('commodity')->where('order_id', $purchase->id)->get();

        return Inertia::render('Admin/Purchases/Detail', [
            'purchase' => $purchase,
            'detail' => $detail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}