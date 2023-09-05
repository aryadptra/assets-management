<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
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
        })->latest()->paginate(10);

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
        $commodities = Commodity::all();

        return Inertia::render('Admin/Orders/Create', [
            'users' => $users,
            'commodities' => $commodities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'user_id' => 'required|string',
            'commodity_id' => 'required|integer',
            
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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
        //
    }
}