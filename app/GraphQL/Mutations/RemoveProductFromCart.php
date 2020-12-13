<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RemoveProductFromCart
{
    public function __invoke($_, array $args)
    {
        $user = Auth::user();
        $user->cart = collect((array) $user->cart)
            ->filter(fn ($value) => $value != $args['product'])
            ->values()
            ->all();
        $user->save();

        return Product::whereIn('id', $user->cart)->get();
    }
}
