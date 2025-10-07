<?php

namespace App\Repositories\Eloquent;

use App\Models\UserAddress;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserAddressRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EloquentUserAddressRepository extends BaseRepository implements UserAddressRepositoryInterface
{
    /**
     * Get the model class handled by this repository.
     *
     * @return class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected function getModelClass(): string
    {
        return UserAddress::class;
    }

    /**
     * Apply filters specific to the UserAddress model.
     *
     * @param Builder $query
     * @param array $filters
     */
    protected function applyFilters($query, array $filters): void
    {
        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (isset($filters['city'])) {
            $query->where('city', 'like', '%' . $filters['city'] . '%');
        }

        if (isset($filters['state'])) {
            $query->where('state', 'like', '%' . $filters['state'] . '%');
        }

        if (isset($filters['country'])) {
            $query->where('country', 'like', '%' . $filters['country'] . '%');
        }

        if (isset($filters['is_default'])) {
            $query->where('is_default', $filters['is_default']);
        }
    }
}