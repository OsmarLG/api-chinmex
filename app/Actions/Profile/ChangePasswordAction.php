<?php

namespace App\Actions\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordAction
{
    /**
     * Execute change password and return user.
     *
     * @param array{current_password:string,new_password:string} $data
     * @return User
     */
    public function execute(array $data): User
    {
        $user = auth()->user();

        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return $user;
    }
}