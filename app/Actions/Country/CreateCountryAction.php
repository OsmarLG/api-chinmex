<?php

namespace App\Actions\Country;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;

class CreateCountryAction
{
    protected CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Execute the create country action
     *
     * @param array $data
     * @return Country
     */
    public function execute(array $data): Country
    {
        return $this->countryRepository->create($data);
    }
}