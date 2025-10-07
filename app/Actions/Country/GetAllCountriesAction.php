<?php

namespace App\Actions\Country;

use App\Repositories\Contracts\CountryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllCountriesAction
{
    protected CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Execute the get all countries action
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function execute(array $filters = []): LengthAwarePaginator
    {
        return $this->countryRepository->paginate($filters);
    }
}