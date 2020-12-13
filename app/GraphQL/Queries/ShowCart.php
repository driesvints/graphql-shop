<?php

namespace App\GraphQL\Queries;

use App\Models\Product;
use App\Models\User;

class ShowCart
{
    public function __invoke($_, array $args)
    {
        $cart = User::find($args['user'])->cart;

        return Product::whereIn('id', $cart)->get();
    }
}
