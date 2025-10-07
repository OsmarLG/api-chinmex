<?php

namespace App\Actions\Country;

use App\Repositories\Contracts\CountryRepositoryInterface;

class DeleteCountryAction
{
    protected CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Execute the delete country action
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function execute(int $id): bool
    {
        $country = $this->countryRepository->find($id);

        if (!$country) {
            throw new \Exception('Country not found');
        }

        return $this->countryRepository->delete($country);
    }
}