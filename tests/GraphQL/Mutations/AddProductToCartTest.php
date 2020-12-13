<?php

namespace Tests\GraphQL\Mutations;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GraphQL\TestCase;

class AddProductToCartTest extends TestCase
{
    use RefreshDatabase;

    public function testQueries(): void
    {
        $product = Product::factory()->create();
        User::factory()->create();

        $this->graphQL(/** @lang GraphQL */ '
            mutation {
              addProductToCart(user:1 product:1) {
                id
                name
                price
              }
            }
        ')->assertJson([
            'data' => [
                'addProductToCart' => [
                    [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                    ],
                ],
            ],
        ]);
    }
}
