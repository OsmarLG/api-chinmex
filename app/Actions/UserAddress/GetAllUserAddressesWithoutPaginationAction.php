<?php

namespace App\Actions\UserAddress;

use App\Repositories\Contracts\UserAddressRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetAllUserAddressesWithoutPaginationAction
{
    protected UserAddressRepositoryInterface $userAddressRepository;

    public function __construct(UserAddressRepositoryInterface $userAddressRepository)
    {
        $this->userAddressRepository = $userAddressRepository;
    }

    /**
     * Execute the get all user addresses action
     *
     * @param array $filters
     * @return Collection
     */
    public function execute(array $filters = []): Collection
    {
        return $this->userAddressRepository->all($filters);
    }
}