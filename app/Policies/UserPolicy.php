<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $authUser): bool
    {
        return $authUser->can('users.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $authUser, User $model): bool
    {
        return $authUser->can('users.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $authUser): bool
    {
        return $authUser->can('users.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $authUser, User $model): bool
    {
        return $authUser->can('users.update');
    }

    /**
     * Determine whether the user can delete the model (soft delete).
     */
    public function delete(User $authUser, User $model): bool
    {
        return $authUser->can('users.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $authUser, User $model): bool
    {
        return $authUser->can('users.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $authUser, User $model): bool
    {
        return $authUser->can('users.force-delete');
    }
}
