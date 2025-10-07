<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryCollection;
use App\Services\CountryService;
use Illuminate\Http\JsonResponse;

class CountryController extends ApiController
{
    protected CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Get all countries
     *
     * Get all countries with optional filtering and pagination support.
     *
     * @response CountryCollection
     */
    public function index(): JsonResponse
    {
        return $this->handleRequest(function () {
            $countries = $this->countryService->getAllCountries([]);
            return new CountryCollection($countries);
        }, 'Países obtenidos exitosamente');
    }

    /**
     * Get a specific country
     *
     * Retrieve detailed information for a specific country by their ID.
     *
     * @response CountryResource
     */
    public function show(int $id): JsonResponse
    {
        return $this->handleRequest(function () use ($id) {
            $country = $this->countryService->getCountryById($id);
            return new CountryResource($country);
        }, 'País obtenido exitosamente');
    }
}