<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;

class UserAddressPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $authUser): bool
    {
        return true; // Users can view their own addresses
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $authUser): bool
    {
        var_dump("L");
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $authUser): bool
    {
        return true; // Users can create their own addresses
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $authUser): bool
    {
        return true;
    }
}