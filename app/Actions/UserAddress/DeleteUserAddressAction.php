<?php

namespace App\Actions\UserAddress;

use App\Repositories\Contracts\UserAddressRepositoryInterface;

class DeleteUserAddressAction
{
    protected UserAddressRepositoryInterface $userAddressRepository;

    public function __construct(UserAddressRepositoryInterface $userAddressRepository)
    {
        $this->userAddressRepository = $userAddressRepository;
    }

    /**
     * Execute the delete user address action
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function execute(int $id): bool
    {
        $userAddress = $this->userAddressRepository->find($id);

        if (!$userAddress) {
            throw new \Exception('User address not found');
        }

        return $this->userAddressRepository->delete($userAddress);
    }
}