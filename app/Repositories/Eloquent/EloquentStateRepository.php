<?php

namespace App\Repositories\Eloquent;

use App\Models\State;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\StateRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EloquentStateRepository extends BaseRepository implements StateRepositoryInterface
{
    /**
     * Get the model class handled by this repository.
     *
     * @return class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected function getModelClass(): string
    {
        return State::class;
    }

    /**
     * Apply filters specific to the State model.
     *
     * @param Builder $query
     * @param array $filters
     */
    protected function applyFilters($query, array $filters): void
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['abbreviation'])) {
            $query->where('abbreviation', 'like', '%' . $filters['abbreviation'] . '%');
        }

        if (isset($filters['country_id'])) {
            $query->where('country_id', $filters['country_id']);
        }
    }
}