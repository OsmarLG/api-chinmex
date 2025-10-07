<?php

namespace App\Actions\UserAddress;

use App\Models\UserAddress;
use App\Repositories\Contracts\UserAddressRepositoryInterface;

class GetUserAddressByIdAction
{
    protected UserAddressRepositoryInterface $userAddressRepository;

    public function __construct(UserAddressRepositoryInterface $userAddressRepository)
    {
        $this->userAddressRepository = $userAddressRepository;
    }

    /**
     * Execute the get user address by id action
     *
     * @param int $id
     * @return UserAddress
     * @throws \Exception
     */
    public function execute(int $id): UserAddress
    {
        $userAddress = $this->userAddressRepository->find($id);

        if (!$userAddress) {
            throw new \Exception('User address not found');
        }

        return $userAddress;
    }
}