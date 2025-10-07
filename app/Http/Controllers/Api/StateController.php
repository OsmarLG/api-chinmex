<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\StateResource;
use App\Http\Resources\StateCollection;
use App\Services\StateService;
use Illuminate\Http\JsonResponse;

class StateController extends ApiController
{
    protected StateService $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    /**
     * Get all states
     *
     * Get all states with optional filtering by country and pagination support.
     *
     * @response StateCollection
     */
    public function index(): JsonResponse
    {
        return $this->handleRequest(function () {
            $states = $this->stateService->getAllStates([]);
            return new StateCollection($states);
        }, 'Estados obtenidos exitosamente');
    }

    /**
     * Get a specific state
     *
     * Retrieve detailed information for a specific state by their ID.
     *
     * @response StateResource
     */
    public function show(int $id): JsonResponse
    {
        return $this->handleRequest(function () use ($id) {
            $state = $this->stateService->getStateById($id);
            return new StateResource($state);
        }, 'Estado obtenido exitosamente');
    }

    /**
     * Get states by country
     *
     * Get all states for a specific country.
     *
     * @response StateCollection
     */
    public function getByCountry(int $countryId): JsonResponse
    {
        return $this->handleRequest(function () use ($countryId) {
            $states = $this->stateService->getAllStates(['country_id' => $countryId]);
            return new StateCollection($states);
        }, 'Estados del país obtenidos exitosamente');
    }
}