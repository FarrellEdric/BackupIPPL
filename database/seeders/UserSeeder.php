<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Owner',
                'email' => 'owner@mieyamin.com',
                'password' => Hash::make('owner321.'),
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@mieyamin.com',
                'password' => Hash::make('kasir321.'),
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
