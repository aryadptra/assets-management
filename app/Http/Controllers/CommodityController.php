<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use App\Models\CommodityCategory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommodityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $commodities = Commodity::when(request()->q, function ($commodities) {
            $commodities = $commodities->where('name', 'like', '%' . request()->q . '%');
        })->with('warehouse', 'category')->latest()->paginate(10);

        $commodities->appends(request()->all());

        $warehouses = Warehouse::all();

        $categories = CommodityCategory::all();

        return Inertia::render('Admin/Commodity/Index', [
            'commodities' => $commodities,
            'warehouses' => $warehouses,
            'categories' => $categories,
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
                'category_id' => 'required|exists:commodity_categories,id',
                'warehouse_id' => 'required|exists:warehouses,id',
                'code' => 'required|string|max:255|unique:commodities,code',
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'stock' => 'required|integer',
                'buying_price' => 'required|integer',
                'selling_price' => 'required|integer',
            ],
            [
                'category_id.required' => 'Kategori harus diisi',
                'category_id.exists' => 'Kategori tidak valid',
                'warehouse_id.required' => 'Gudang harus diisi',
                'warehouse_id.exists' => 'Gudang tidak valid',
                'code.required' => 'Kode harus diisi',
                'code.string' => 'Kode harus berupa string',
                'code.max' => 'Kode maksimal 255 karakter',
                'name.required' => 'Nama harus diisi',
                'name.string' => 'Nama harus berupa string',
                'name.max' => 'Nama maksimal 255 karakter',
                'description.required' => 'Deskripsi harus diisi',
                'description.string' => 'Deskripsi harus berupa string',
                'description.max' => 'Deskripsi maksimal 255 karakter',
                'stock.required' => 'Stok harus diisi',
                'stock.integer' => 'Stok harus berupa angka',
                'buying_price.required' => 'Harga beli harus diisi',
                'buying_price.integer' => 'Harga beli harus berupa angka',
                'selling_price.required' => 'Harga jual harus diisi',
                'selling_price.integer' => 'Harga jual harus berupa angka',
            ]
        );

        $data = [
            'category_id' => $request->input('category_id'),
            'warehouse_id' => $request->input('warehouse_id'),
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'buying_price' => $request->input('buying_price'),
            'selling_price' => $request->input('selling_price'),
        ];

        $create = Commodity::create($data);

        if (!$create) {
            return to_route('commodities.index');
        }

        return to_route('commodities.index')->with(['success' => 'Komoditas berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // data berdasarkan id
        $commodity = Commodity::findOrFail($id);

        return Inertia::render('Admin/Commodity/Show', [
            'commodity' => $commodity,
        ]);
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
    public function update(Request $request, Commodity $commodity)
    {
        $request->validate(
            [
                'category_id' => 'required|exists:commodity_categories,id',
                'warehouse_id' => 'required|exists:warehouses,id',
                'code' => 'required|string|max:255|unique:commodities,code,' . $commodity->id,
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'stock' => 'required|integer',
                'buying_price' => 'required|integer',
                'selling_price' => 'required|integer',
            ],
            [
                'category_id.required' => 'Kategori harus diisi',
                'category_id.exists' => 'Kategori tidak valid',
                'warehouse_id.required' => 'Gudang harus diisi',
                'warehouse_id.exists' => 'Gudang tidak valid',
                'name.required' => 'Nama harus diisi',
                'name.string' => 'Nama harus berupa string',
                'name.max' => 'Nama maksimal 255 karakter',
                'description.required' => 'Deskripsi harus diisi',
                'description.string' => 'Deskripsi harus berupa string',
                'description.max' => 'Deskripsi maksimal 255 karakter',
                'stock.required' => 'Stok harus diisi',
                'stock.integer' => 'Stok harus berupa angka',
                'buying_price.required' => 'Harga beli harus diisi',
                'buying_price.integer' => 'Harga beli harus berupa angka',
                'selling_price.required' => 'Harga jual harus diisi',
                'selling_price.integer' => 'Harga jual harus berupa angka',
            ]
        );

        $data = [
            'category_id' => $request->input('category_id'),
            'warehouse_id' => $request->input('warehouse_id'),
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'buying_price' => $request->input('buying_price'),
            'selling_price' => $request->input('selling_price'),
        ];

        $update = $commodity->update($data);

        if (!$update) {
            return to_route('commodities.index');
        }

        return to_route('commodities.index')->with(['success' => 'Komoditas berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete
        $delete = Commodity::findOrFail($id)->forceDelete();

        if (!$delete) {
            return to_route('commodities.index');
        }

        return to_route('commodities.index')->with(['success' => 'Komoditas berhasil dihapus']);
    }
}
