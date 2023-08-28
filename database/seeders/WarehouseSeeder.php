<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouse = [
            [
                'name' => 'Gudang A',
                'address' => 'Jl. Gudang A',
                'phone' => '081234567890',
                'pic' => 'Asep Amirudin',
            ],
            [
                'name' => 'Gudang B',
                'address' => 'Jl. Gudang B',
                'phone' => '081234567890',
                'pic' => 'Asep Burhanudin',
            ],
            [
                'name' => 'Gudang C',
                'address' => 'Jl. Gudang C',
                'phone' => '081234567890',
                'pic' => 'Asep Chairudin',
            ],
            [
                'name' => 'Gudang D',
                'address' => 'Jl. Gudang D',
                'phone' => '081234567890',
                'pic' => 'Asep Denirudin',
            ],
            [
                'name' => 'Gudang E',
                'address' => 'Jl. Gudang E',
                'phone' => '081234567890',
                'pic' => 'Asep Emanudin',
            ],
        ];

        foreach ($warehouse as $key => $value) {
            \App\Models\Warehouse::create($value);
        }
    }
}
