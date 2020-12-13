<?php

namespace App\GraphQL\Mutations;

use Error;
use Illuminate\Support\Facades\Auth;

class Login
{
    public function __invoke($_, array $args)
    {
        $guard = Auth::guard();

        if (! $guard->attempt($args)) {
            throw new Error('Invalid credentials.');
        }

        return $guard->user();
    }
}
