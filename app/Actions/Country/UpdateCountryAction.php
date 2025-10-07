<?php

namespace App\Actions\Country;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;

class UpdateCountryAction
{
    protected CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Execute the update country action
     *
     * @param int $id
     * @param array $data
     * @return Country
     * @throws \Exception
     */
    public function execute(int $id, array $data): Country
    {
        $country = $this->countryRepository->find($id);

        if (!$country) {
            throw new \Exception('Country not found');
        }

        return $this->countryRepository->update($country, $data);
    }
}