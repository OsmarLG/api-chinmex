<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\LovsService;
use Illuminate\Http\JsonResponse;

class LovsController extends ApiController
{
    protected LovsService $lovsService;

    public function __construct(LovsService $lovsService)
    {
        $this->lovsService = $lovsService;
    }

    /**
     * Get all countries for LOVs
     *
     * @return JsonResponse
     */
    public function countries(): JsonResponse
    {
        return $this->handleRequest(function () {
            return $this->lovsService->getAllCountries();
        }, 'Países obtenidos exitosamente');
    }

    /**
     * Get all states for LOVs
     *
     * @return JsonResponse
     */
    public function states(): JsonResponse
    {
        return $this->handleRequest(function () {
            return $this->lovsService->getAllStates();
        }, 'Estados obtenidos exitosamente');
    }
}