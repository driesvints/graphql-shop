<?php

namespace Tests\GraphQL\Queries;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GraphQL\TestCase;

class ShowCartTest extends TestCase
{
    use RefreshDatabase;

    public function testQueries(): void
    {
        $product = Product::factory()->count(3)->create()->first();
        User::factory()->create(['cart' => [1, 3]]);

        $this->graphQL(/** @lang GraphQL */ '
            query ShowCart {
              showCart(user:1) {
                id
                name
                description
                price
              }
            }
        ')->assertJson([
            'data' => [
                'showCart' => [
                    [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                    ],
                ],
            ],
        ]);
    }
}
