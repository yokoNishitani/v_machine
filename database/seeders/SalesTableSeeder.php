<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales_params = [
            'id' => 1,
            'product_id' => 1,
        ];
        DB::table('sales')->insert($sales_params);

        $sales_params = [
            'id' => 2,
            'product_id' => 2,
        ];
        DB::table('sales')->insert($sales_params);

        $sales_params = [
            'id' => 3,
            'product_id' => 3,
        ];
        DB::table('sales')->insert($sales_params);
    }
}
