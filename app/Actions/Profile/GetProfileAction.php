<?php

namespace App\Actions\Profile;

use App\Models\User;

class GetProfileAction
{
    /**
     * Execute get profile and return user.
     *
     * @return User
     */
    public function execute(): User
    {
        return auth()->user();
    }
}