<?php

namespace App\GraphQL\Queries;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ShowCart
{
    public function __invoke($_, array $args)
    {
        $cart = Auth::user()->cart;

        return Product::whereIn('id', $cart)->get();
    }
}
