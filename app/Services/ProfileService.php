<?php

namespace App\Services;

use App\Actions\Profile\UpdateProfileAction;
use App\Actions\Profile\ChangePasswordAction;
use App\Actions\Profile\LogoutAction;
use App\Actions\Profile\GetProfileAction;

class ProfileService extends BaseService
{
    /**
     * Get Profile
     *
     * @return \App\Models\User
     */
    public function getProfile(): \App\Models\User
    {
        return $this->callAction(GetProfileAction::class);
    }

    /**
     * Update Profile
     *
     * @param array{name:string,username?:string,email:string,password:string} $credentials
     * @return \App\Models\User
     */
    public function updateProfile(array $credentials): \App\Models\User
    {
        return $this->callAction(UpdateProfileAction::class, $credentials);
    }

    /**
     * Change Password
     *
     * @param array{current_password:string,new_password:string} $data
     * @return array{user: \App\Models\User, token: string}
     */
    public function changePassword(array $data): \App\Models\User
    {
        return $this->callAction(ChangePasswordAction::class, $data);
    }

    /**
     * Logout
     *
     * @return array{status:string}
     */
    public function logout(): array
    {
        return $this->callAction(LogoutAction::class);
    }
}
