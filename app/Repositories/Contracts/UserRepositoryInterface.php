<?php

namespace App\Repositories\Contracts;

/**
 * Interface UserRepositoryInterface
 *
 * Extends the generic BaseRepositoryInterface for User-specific repositories.
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find a model by ID including soft-deleted.
     */
    public function findWithTrashed(int $id): ?\Illuminate\Database\Eloquent\Model;

    /**
     * Restore a soft-deleted model by ID.
     */
    public function restore(int $id): bool;

    /**
     * Permanently delete a model by ID.
     */
    public function forceDelete(int $id): bool;
}
