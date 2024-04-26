<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $products_params = [
            'id' => 1,
            'company_id' => 1,
            'product_name' => 'お水',
            'price' => 120,
            'stock' => 10
        ];
        DB::table('products')->insert($products_params);

        $products_params = [
            'id' => 2,
            'company_id' => 2,
            'product_name' => 'お茶',
            'price' => 140,
            'stock' => 8
        ];
        DB::table('products')->insert($products_params);

        $products_params = [
            'id' => 3,
            'company_id' => 3,
            'product_name' => 'オレンジジュース',
            'price' => 160,
            'stock' => 12
        ];
        DB::table('products')->insert($products_params);
    }
}