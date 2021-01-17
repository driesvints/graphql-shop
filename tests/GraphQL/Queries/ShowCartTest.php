<?php

namespace Tests\GraphQL\Queries;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GraphQL\TestCase;

class ShowCartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_show_the_cart_contents(): void
    {
        $product = Product::factory()->count(3)->create()->first();
        $user = User::factory()->create(['cart' => [1, 3]]);

        $this->be($user);

        $this->graphQL(/** @lang GraphQL */ '
            query ShowCart {
              showCart {
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
