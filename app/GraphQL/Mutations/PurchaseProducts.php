<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Exceptions\NoCartProducts;
use App\Models\Product;
use App\Models\User;

class PurchaseProducts
{
    public function __invoke($_, array $args)
    {
        $user = User::find($args['user']);
        $products = Product::whereIn('id', (array) $user->cart)->get();

        if ($products->isEmpty()) {
            throw new NoCartProducts;
        }

        $order = $user->orders()->create(['total' => $products->sum(fn ($product) => $product->price)]);

        $order->products()->sync($products);

        $user->update(['cart' => []]);

        return $order->refresh();
    }
}
