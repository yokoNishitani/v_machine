<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_params = [
            'user_name' => '鈴木',
            'email' => 'suzuki@vmachine.com',
            'password' => 'suzukidesu',
        ];
        DB::table('users')->insert($users_params);

        $users_params = [
            'user_name' => '田中',
            'email' => 'tanaka@vmachine.com',
            'password' => 'tanakadesu',
        ];
        DB::table('users')->insert($users_params);

        $users_params = [
            'user_name' => '小林',
            'email' => 'kobayashi@vmachine.com',
            'password' => 'kobayashidesu',
        ];
        DB::table('users')->insert($users_params);
    }
}
