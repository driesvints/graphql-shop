<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;

class Logout
{
    public function __invoke($_, array $args)
    {
        $guard = Auth::guard();

        /** @var \App\Models\User|null $user */
        $user = $guard->user();

        $guard->logout();

        return $user;
    }
}
