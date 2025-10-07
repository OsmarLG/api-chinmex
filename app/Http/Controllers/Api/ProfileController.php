<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\UserAddress\StoreUserAddressRequest;
use App\Http\Requests\UserAddress\UpdateUserAddressRequest;
use App\Http\Resources\UserAddressResource;
use App\Http\Resources\UserAddressCollection;
use App\Http\Resources\UserResource;
use App\Services\ProfileService;
use App\Services\UserAddressService;
use Illuminate\Http\JsonResponse;

class ProfileController extends ApiController
{
    protected ProfileService $profileService;
    protected UserAddressService $userAddressService;

    public function __construct(ProfileService $profileService, UserAddressService $userAddressService)
    {
        $this->profileService = $profileService;
        $this->userAddressService = $userAddressService;
    }

    /**
     * Get Profile
     *
     * Obtiene el perfil del usuario autenticado.
     *
     * @response UserResource
     */
    public function getProfile(): JsonResponse
    {
        return $this->handleRequest(function () {
            $payload = $this->profileService->getProfile();
            return new UserResource($payload);
        }, 'Perfil obtenido exitosamente');
    }

     /**
     * Update Profile
     *
     * Actualiza el perfil del usuario autenticado.
     *
     * @response UserResource
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $payload = $this->profileService->updateProfile($request->validated());
            return new UserResource($payload);
        }, 'Perfil actualizado exitosamente');
    }

    /**
     * Change Password
     *
     * Cambia la contraseña del usuario autenticado.
     *
     * @response UserResource
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $payload = $this->profileService->changePassword($request->validated());
            return new UserResource($payload);
        }, 'Contraseña cambiada exitosamente', 201);
    }

    /**
     * Logout
     *
     * Cierra la sesión del usuario autenticado.
     *
     * @response {"status": true, "message": "Sesión cerrada exitosamente"}
     */
    public function logout(): JsonResponse
    {
        return $this->handleRequest(function () {
            $this->profileService->logout();
            return [
                'status' => true,
                'message' => 'Sesión cerrada exitosamente',
            ];
        }, 'Sesión cerrada exitosamente');
    }

    /**
     * Get User Addresses
     *
     * Obtiene las direcciones del usuario autenticado.
     *
     * @response UserAddressCollection
     */
    public function getAddresses(): JsonResponse
    {
        return $this->handleRequest(function () {
            $user = auth()->user();
            $addresses = $this->userAddressService->getAllUserAddresses(['user_id' => $user->id]);
            return new UserAddressCollection($addresses);
        }, 'Direcciones obtenidas exitosamente');
    }

    /**
     * Create User Address
     *
     * Crea una nueva dirección para el usuario autenticado.
     *
     * @response UserAddressResource
     */
    public function createAddress(StoreUserAddressRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $data = array_merge($request->validated(), ['user_id' => auth()->id()]);
            $address = $this->userAddressService->createUserAddress($data);
            return new UserAddressResource($address);
        }, 'Dirección creada exitosamente', 201);
    }

    /**
     * Update User Address
     *
     * Actualiza una dirección del usuario autenticado.
     *
     * @response UserAddressResource
     */
    public function updateAddress(UpdateUserAddressRequest $request, int $addressId): JsonResponse
    {
        return $this->handleRequest(function () use ($request, $addressId) {
            $address = $this->userAddressService->updateUserAddress($addressId, $request->validated());
            return new UserAddressResource($address);
        }, 'Dirección actualizada exitosamente');
    }

    /**
     * Delete User Address
     *
     * Elimina una dirección del usuario autenticado.
     *
     * @response 200 {"status": true, "message": "Dirección eliminada exitosamente", "errors": [], "data": null}
     */
    public function deleteAddress(int $addressId): JsonResponse
    {
        return $this->handleRequest(function () use ($addressId) {
            $this->userAddressService->deleteUserAddress($addressId);
            return null;
        }, 'Dirección eliminada exitosamente');
    }
}
