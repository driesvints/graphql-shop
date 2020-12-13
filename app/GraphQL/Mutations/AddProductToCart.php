<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use App\Models\User;

class AddProductToCart
{
    public function __invoke($_, array $args)
    {
        $user = User::find($args['user']);
        $user->cart = array_unique(array_merge((array) $user->cart, [$args['product']]));
        $user->save();

        return Product::whereIn('id', $user->cart)->get();
    }
}
