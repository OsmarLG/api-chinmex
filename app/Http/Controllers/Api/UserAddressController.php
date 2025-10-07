<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserAddress\StoreUserAddressRequest;
use App\Http\Requests\UserAddress\UpdateUserAddressRequest;
use App\Http\Resources\UserAddressResource;
use App\Http\Resources\UserAddressCollection;
use App\Services\UserAddressService;
use Illuminate\Http\JsonResponse;
use App\Models\UserAddress;

class UserAddressController extends ApiController
{
    protected UserAddressService $userAddressService;

    public function __construct(UserAddressService $userAddressService)
    {
        $this->userAddressService = $userAddressService;
        // Apply policy authorization to resource methods
        // $this->authorizeResource(UserAddress::class, 'userAddress');
    }

    /**
     * Get all user addresses
     *
     * Get all user addresses with optional filtering and pagination support.
     *
     * @response UserAddressCollection
     */
    public function index(): JsonResponse
    {
        return $this->handleRequest(function () {
            $userAddresses = $this->userAddressService->getAllUserAddresses([]);
            return new UserAddressCollection($userAddresses);
        }, 'Direcciones de usuario obtenidas exitosamente');
    }

    /**
     * Get a specific user address
     *
     * Retrieve detailed information for a specific user address by their ID.
     *
     * @response UserAddressResource
     */
    public function show(UserAddress $userAddress): JsonResponse
    {
        return $this->handleRequest(function () use ($userAddress) {
            $userAddress = $this->userAddressService->getUserAddressById($userAddress->id);
            return new UserAddressResource($userAddress);
        }, 'Dirección de usuario obtenida exitosamente');
    }

    /**
     * Create a new user address
     *
     * Create a new user address with the provided information.
     *
     * @response UserAddressResource
     */
    public function store(StoreUserAddressRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $userAddress = $this->userAddressService->createUserAddress($request->validated());
            return new UserAddressResource($userAddress);
        }, 'Dirección de usuario creada exitosamente', 201);
    }

    /**
     * Update an existing user address
     *
     * Update user address information.
     *
     * @response UserAddressResource
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress): JsonResponse
    {
        return $this->handleRequest(function () use ($request, $userAddress) {
            $userAddress = $this->userAddressService->updateUserAddress($userAddress->id, $request->validated());
            return new UserAddressResource($userAddress);
        }, 'Dirección de usuario actualizada exitosamente');
    }

    /**
     * Delete a user address
     *
     * Permanently delete a user address from the system.
     *
     * @response 200 {"status": true, "message": "Dirección de usuario eliminada exitosamente", "errors": [], "data": null}
     */
    public function destroy(UserAddress $userAddress): JsonResponse
    {
        return $this->handleRequest(function () use ($userAddress) {
            $this->userAddressService->deleteUserAddress($userAddress->id);
            return null;
        }, 'Dirección de usuario eliminada exitosamente');
    }
}