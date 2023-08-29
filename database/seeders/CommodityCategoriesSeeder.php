<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommodityCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create dummy data
        $commodityCategories = [
            [
                'name' => 'Kabel Drop Core',
                'code' => 'KDC'
            ],
            [
                'name' => 'Kabel Precon',
                'code' => 'KPC'
            ],
            [
                'name' => 'Modem',
                'code' => 'MDM'
            ],
            [
                'name' => 'Optical Distribution Point',
                'code' => 'ODP'
            ]
        ];

        // Insert to database
        foreach ($commodityCategories as $commodityCategory) {
            \App\Models\CommodityCategory::create($commodityCategory);
        }
    }
}
