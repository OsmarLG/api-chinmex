<?php

namespace App\Services;

use App\Actions\Country\GetAllCountriesAction;
use App\Actions\Country\GetCountryByIdAction;
use App\Actions\Country\CreateCountryAction;
use App\Actions\Country\UpdateCountryAction;
use App\Actions\Country\DeleteCountryAction;
use App\Models\Country;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryService extends BaseService
{
    /**
     * Get all countries with optional filtering and pagination
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllCountries(array $filters = []): LengthAwarePaginator
    {
        return $this->callAction(GetAllCountriesAction::class, $filters);
    }

    /**
     * Get a specific country by ID
     *
     * @param int $id
     * @return Country
     * @throws \Exception
     */
    public function getCountryById(int $id): Country
    {
        return $this->callAction(GetCountryByIdAction::class, $id);
    }

    /**
     * Create a new country
     *
     * @param array $data
     * @return Country
     */
    public function createCountry(array $data): Country
    {
        return $this->callAction(CreateCountryAction::class, $data);
    }

    /**
     * Update an existing country
     *
     * @param int $id
     * @param array $data
     * @return Country
     * @throws \Exception
     */
    public function updateCountry(int $id, array $data): Country
    {
        return $this->callAction(UpdateCountryAction::class, $id, $data);
    }

    /**
     * Delete a country
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteCountry(int $id): bool
    {
        return $this->callAction(DeleteCountryAction::class, $id);
    }
}