<?php

namespace App\Actions\UserAddress;

use App\Models\UserAddress;
use App\Repositories\Contracts\UserAddressRepositoryInterface;

class UpdateUserAddressAction
{
    protected UserAddressRepositoryInterface $userAddressRepository;

    public function __construct(UserAddressRepositoryInterface $userAddressRepository)
    {
        $this->userAddressRepository = $userAddressRepository;
    }

    /**
     * Execute the update user address action
     *
     * @param int $id
     * @param array $data
     * @return UserAddress
     * @throws \Exception
     */
    public function execute(int $id, array $data): UserAddress
    {
        $userAddress = $this->userAddressRepository->find($id);

        if (!$userAddress) {
            throw new \Exception('User address not found');
        }

        return $this->userAddressRepository->update($userAddress, $data);
    }
}