<?php

namespace App\Repositories\Eloquent;

use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EloquentCountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    /**
     * Get the model class handled by this repository.
     *
     * @return class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected function getModelClass(): string
    {
        return Country::class;
    }

    /**
     * Apply filters specific to the Country model.
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
    }
}