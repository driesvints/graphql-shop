<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Exceptions\NoCartProducts;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PurchaseProducts
{
    public function __invoke($_, array $args)
    {
        $user = Auth::user();
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
