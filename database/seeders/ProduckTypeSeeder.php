<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduckTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $product_types = [
        ["furniture", "Furniture"],
        ["pakaian", "Pakaian"],
        ["Alat", "Alat-alat"],
    ];

    public function run(): void
    {
        foreach ($this->product_types as $product_type) {
            \App\Models\ProduckType::create([
                // "guid" => $role[0],
                // "guid" => $role[0],
                "product_type_name" => $product_type[1],
            ]);
        }
    }
}