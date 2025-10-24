<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // buat 50 orders dummy
        for ($i = 0; $i < 50; $i++) {
            $userIds = \App\Models\User::pluck('id')->toArray();

            for ($i = 0; $i < 50; $i++) {
                Order::create([
                    'user_id' => count($userIds) ? $faker->randomElement($userIds) : null,
                    'customer_name' => $faker->name,
                    'total' => rand(10000, 500000),
                    'status' => $faker->randomElement(['unpaid', 'paid', 'other']),
                    'payment_status' => $faker->randomElement(['pending', 'paid', 'failed']),
                    'payment_method' => $faker->randomElement(['cash', 'qr', 'bank_transfer', 'other']),
                    'transaction_id' => $faker->uuid(),
                    'created_at' => Carbon::now()->subDays(rand(0, 5)),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
