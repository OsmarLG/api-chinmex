<?php

namespace App\Actions\UserAddress;

use App\Repositories\Contracts\UserAddressRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllUserAddressesAction
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
     * @return LengthAwarePaginator
     */
    public function execute(array $filters = []): LengthAwarePaginator
    {
        return $this->userAddressRepository->paginate($filters);
    }
}