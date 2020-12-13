<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create(['email' => 'dries@example.com', 'name' => 'Dries']);

        $products = [
            Product::factory()->create([
                'name' => 'Laravel "Boneman" Shirt',
                'price' => 2999,
            ]),
            Product::factory()->create([
                'name' => 'Laravel "Hambino" Baseball Cap',
                'price' => 2499,
            ]),
            Product::factory()->create([
                'name' => 'Laravel "Sunrise" Mug',
                'price' => 1499,
            ]),
        ];

        for ($i = 0; $i < 25; $i++) {
            Order::factory()->hasAttached(
                Arr::random($products, rand(1, count($products)))
            )->create(['user_id' => $user->id]);
        }
    }
}
