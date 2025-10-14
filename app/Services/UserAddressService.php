<?php

namespace App\Services;

use App\Actions\UserAddress\GetAllUserAddressesAction;
use App\Actions\UserAddress\GetAllUserAddressesWithoutPaginationAction;
use App\Actions\UserAddress\GetUserAddressByIdAction;
use App\Actions\UserAddress\CreateUserAddressAction;
use App\Actions\UserAddress\UpdateUserAddressAction;
use App\Actions\UserAddress\DeleteUserAddressAction;
use App\Models\UserAddress;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserAddressService extends BaseService
{
    /**
     * Get all user addresses with optional filtering and pagination
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllUserAddresses(array $filters = []): LengthAwarePaginator
    {
        return $this->callAction(GetAllUserAddressesAction::class, $filters);
    }

    /**
     * Get all user addresses without pagination
     *
     * @param array $filters
     * @return Collection
     */
    public function getAllUserAddressesWithoutPagination(array $filters = []): Collection
    {
        return $this->callAction(GetAllUserAddressesWithoutPaginationAction::class, $filters);
    }

    /**
     * Get a specific user address by ID
     *
     * @param int $id
     * @return UserAddress
     * @throws \Exception
     */
    public function getUserAddressById(int $id): UserAddress
    {
        return $this->callAction(GetUserAddressByIdAction::class, $id);
    }

    /**
     * Create a new user address
     *
     * @param array $data
     * @return UserAddress
     */
    public function createUserAddress(array $data): UserAddress
    {
        return $this->callAction(CreateUserAddressAction::class, $data);
    }

    /**
     * Update an existing user address
     *
     * @param int $id
     * @param array $data
     * @return UserAddress
     * @throws \Exception
     */
    public function updateUserAddress(int $id, array $data): UserAddress
    {
        return $this->callAction(UpdateUserAddressAction::class, $id, $data);
    }

    /**
     * Delete a user address
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteUserAddress(int $id): bool
    {
        return $this->callAction(DeleteUserAddressAction::class, $id);
    }
}