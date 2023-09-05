<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get data
        $suppliers = Supplier::when(request()->q, function ($suppliers) {
            $suppliers = $suppliers->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        // append query string to pagination links
        $suppliers->appends(request()->all());

        // render with inertia
        return Inertia::render('Admin/Suppliers/Index', [
            'suppliers' => $suppliers
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
        // Save data
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:suppliers,name',
                'email' => 'required|string|max:255|unique:suppliers,email',
                'phone' => 'required|integer|unique:suppliers,phone',
                'address' => 'required|string|max:255|unique:suppliers,address'
            ],
            [
                'name.required' => 'Nama supplier harus diisi',
                'name.string' => 'Nama supplier harus berupa string',
                'name.max' => 'Nama supplier tidak boleh lebih dari 255 karakter',
                'name.unique' => 'Nama supplier sudah terdaftar',
                'email.required' => 'Email supplier harus diisi',
                'email.string' => 'Email supplier harus berupa string',
                'email.max' => 'Email supplier tidak boleh lebih dari 255 karakter',
                'email.unique' => 'Email supplier sudah terdaftar',
                'phone.required' => 'Nomor telepon supplier harus diisi',
                'phone.number' => 'Nomor telepon supplier harus berupa angka',
                'phone.unique' => 'Nomor telepon supplier sudah terdaftar',
                'address.required' => 'Alamat supplier harus diisi',
                'address.string' => 'Alamat supplier harus berupa string',
            ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $create = Supplier::create($data);

        if (!$create) {
            return to_route('supliers.index');
        }

        return to_route('suppliers.index')->with(['success' => 'Supplier berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Update data
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone' => 'required|integer',
                'address' => 'required|string|max:255'
            ],
            [
                'name.required' => 'Nama supplier harus diisi',
                'name.string' => 'Nama supplier harus berupa string',
                'name.max' => 'Nama supplier tidak boleh lebih dari 255 karakter',
                'email.required' => 'Email supplier harus diisi',
                'email.string' => 'Email supplier harus berupa string',
                'email.max' => 'Email supplier tidak boleh lebih dari 255 karakter',
                'phone.required' => 'Nomor telepon supplier harus diisi',
                'phone.number' => 'Nomor telepon supplier harus berupa angka',
                'address.required' => 'Alamat supplier harus diisi',
                'address.string' => 'Alamat supplier harus berupa string',
            ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $update = $supplier->update($data);

        if (!$update) {
            return to_route('suppliers.index');
        }

        return to_route('suppliers.index')->with(['success' => 'Supplier berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
