<?php

namespace App\Actions\UserAddress;

use App\Models\UserAddress;
use App\Repositories\Contracts\UserAddressRepositoryInterface;

class CreateUserAddressAction
{
    protected UserAddressRepositoryInterface $userAddressRepository;

    public function __construct(UserAddressRepositoryInterface $userAddressRepository)
    {
        $this->userAddressRepository = $userAddressRepository;
    }

    /**
     * Execute the create user address action
     *
     * @param array $data
     * @return UserAddress
     */
    public function execute(array $data): UserAddress
    {
        return $this->userAddressRepository->create($data);
    }
}