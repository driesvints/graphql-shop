<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AddProductToCart
{
    public function __invoke($_, array $args)
    {
        $user = Auth::user();
        $user->cart = array_unique(array_merge((array) $user->cart, [$args['product']]));
        $user->save();

        return Product::whereIn('id', $user->cart)->get();
    }
}
