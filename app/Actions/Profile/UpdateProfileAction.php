<?php

namespace App\Actions\Profile;

use App\Models\User;

class UpdateProfileAction
{
    /**
     * Execute update profile and return user.
     *
     * @param array{name:string,username?:string,email:string,password?:string} $data
     * @return User
     */
    public function execute(array $data): User
    {
        $user = auth()->user();

        $user->update($data);

        return $user;
    }
}