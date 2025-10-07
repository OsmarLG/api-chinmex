<?php

namespace App\Actions\Country;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;

class GetCountryByIdAction
{
    protected CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Execute the get country by id action
     *
     * @param int $id
     * @return Country
     * @throws \Exception
     */
    public function execute(int $id): Country
    {
        $country = $this->countryRepository->find($id);

        if (!$country) {
            throw new \Exception('Country not found');
        }

        return $country;
    }
}