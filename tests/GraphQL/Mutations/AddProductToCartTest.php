<?php

namespace Tests\GraphQL\Mutations;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GraphQL\TestCase;

class AddProductToCartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_a_product_to_the_cart(): void
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();

        $this->be($user);

        $this->graphQL(/** @lang GraphQL */ '
            mutation {
              addProductToCart(product:1) {
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
