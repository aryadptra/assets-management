<?php

namespace App\Http\Controllers;

use App\Models\CommodityCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommodityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get categories
        $categories = CommodityCategory::when(request()->q, function ($categories) {
            $categories = $categories->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        // append query string to pagination links
        $categories->appends(request()->all());

        // render with inertia
        return Inertia::render('Admin/CommodityCategories/Index', [
            'categories' => $categories
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
                'code' => 'required|string|max:255|unique:commodity_categories,code',
                'name' => 'required|string|max:255',
            ],
            [
                'code.required' => 'Kode kategori harus diisi',
                'code.string' => 'Kode kategori harus berupa string',
                'code.max' => 'Kode kategori maksimal 10 karakter',
                'code.unique' => 'Kode kategori sudah ada',
                'name.required' => 'Nama kategori harus diisi',
                'name.string' => 'Nama kategori harus berupa string',
                'name.max' => 'Nama kategori maksimal 255 karakter',
            ]
        );

        $create = CommodityCategory::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
        ]);

        if (!$create) {
            return to_route('categories.index');
        }
        return to_route('categories.index')->with(['success' => 'Kategori berhasil ditambahkan']);
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
                'code' => 'required|string|max:255|unique:commodity_categories,code,' . $id,
                'name' => 'required|string|max:255',
            ],
            [
                'code.required' => 'Kode kategori harus diisi',
                'code.string' => 'Kode kategori harus berupa string',
                'code.max' => 'Kode kategori maksimal 10 karakter',
                'code.unique' => 'Kode kategori sudah ada',
                'name.required' => 'Nama kategori harus diisi',
                'name.string' => 'Nama kategori harus berupa string',
                'name.max' => 'Nama kategori maksimal 255 karakter',
            ]
        );

        $update = CommodityCategory::where('id', $id)->update([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
        ]);

        if (!$update) {
            return to_route('categories.index');
        }
        return to_route('categories.index')->with(['success' => 'Kategori berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CommodityCategory::findOrFail($id);
        $category->forceDelete();
        return to_route('categories.index')->with('success', 'Berhasil menghapus gudang');
    }
}
