<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'PT. Supplier 1',
            'email' => 'ptspplier@gmail.com',
            'phone' => '08123456789',
            'address' => 'Jl. Asia Afrika',
        ]);
    }
}
