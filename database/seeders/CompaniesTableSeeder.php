<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $companies_params = [
            'id' => 1,
            'company_name' => 'サントリー',
        ];
        DB::table('companies')->insert($companies_params);

        $companies_params = [
            'id' => 2,
            'company_name' => 'キリン',
        ];
        DB::table('companies')->insert($companies_params);

        $companies_params = [
            'id' => 3,
            'company_name' => 'サッポロ',
        ];
        DB::table('companies')->insert($companies_params);
    }
}