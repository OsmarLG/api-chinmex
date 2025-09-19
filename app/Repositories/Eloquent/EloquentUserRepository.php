<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EloquentUserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Get the model class handled by this repository.
     *
     * @return class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    /**
     * Apply filters specific to the User model.
     *
     * @param Builder $query
     * @param array $filters
     */
    protected function applyFilters($query, array $filters): void
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['username'])) {
            $query->where('username', 'like', '%' . $filters['username'] . '%');
        }

        if (isset($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (isset($filters['created_from'])) {
            $query->where('created_at', '>=', $filters['created_from']);
        }

        if (isset($filters['created_to'])) {
            $query->where('created_at', '<=', $filters['created_to']);
        }
    }

    /**
     * Find a user including soft-deleted.
     */
    public function findWithTrashed(int $id): ?\Illuminate\Database\Eloquent\Model
    {
        return User::withTrashed()->find($id);
    }

    /**
     * Restore a soft-deleted user by ID.
     */
    public function restore(int $id): bool
    {
        /** @var \App\Models\User|null $user */
        $user = User::withTrashed()->find($id);
        if (!$user) {
            return false;
        }
        $restored = (bool) $user->restore();
        if ($restored) {
            $this->clearCache();
        }
        return $restored;
    }

    /**
     * Permanently delete a user by ID.
     */
    public function forceDelete(int $id): bool
    {
        /** @var \App\Models\User|null $user */
        $user = User::withTrashed()->find($id);
        if (!$user) {
            return false;
        }
        $deleted = (bool) $user->forceDelete();
        if ($deleted) {
            $this->clearCache();
        }
        return $deleted;
    }
}
