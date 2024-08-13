<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedUser = [
            [
                'name' => 'testuser',
                'email' => 'test@gmail.com',
                'password' => '$2y$10$QHcrZSeeb4E2rltHq2T6L.xUCyJs2kkgzvLpkXiTo.IzMXaK/BnYG',
            ],
        ];

        DB::table('users')->insert($seedUser);
    }
}
