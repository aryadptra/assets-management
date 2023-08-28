<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get lesson
        $warehouse = Warehouse::when(request()->q, function ($warehouse) {
            $warehouse = $warehouse->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        // append query string to pagination links
        $warehouse->appends(request()->all());

        // render with inertia
        return Inertia::render('Admin/Warehouses/Index', [
            'warehouses' => $warehouse
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'required|numeric',
                'pic' => 'required|string',
            ],
            [
                'name.required' => 'Nama gudang harus diisi',
                'address.required' => 'Alamat gudang harus diisi',
                'phone.required' => 'Nomor telepon gudang harus diisi',
                'pic.required' => 'Nama PIC gudang harus diisi',
            ]
        );

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'pic' => $request->pic,
        ];

        $create = Warehouse::create($data);

        if (!$create) {
            return to_route('warehouses.index')->with('danger', 'Gagal menambahkan gudang');
        }

        return to_route('warehouses.index')->with('success', 'Berhasil menambahkan gudang');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'required|numeric',
                'pic' => 'required|string',
            ],
            [
                'name.required' => 'Nama gudang harus diisi',
                'address.required' => 'Alamat gudang harus diisi',
                'phone.required' => 'Nomor telepon gudang harus diisi',
                'pic.required' => 'Nama PIC gudang harus diisi',
            ]
        );

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'pic' => $request->pic,
        ];

        $warehouse = Warehouse::findOrFail($id);
        $update = $warehouse->update($data);

        if (!$update) {
            return to_route('warehouses.index')->with('danger', 'Gagal mengubah gudang');
        }
        return to_route('warehouses.index')->with('success', 'Berhasil mengubah gudang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->forceDelete();
        return to_route('warehouses.index')->with('success', 'Berhasil menghapus gudang');
    }
}
