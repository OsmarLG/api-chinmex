<?php

namespace App\Actions\State;

use App\Repositories\Contracts\StateRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllStatesAction
{
    protected StateRepositoryInterface $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Execute the get all states action
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function execute(array $filters = []): LengthAwarePaginator
    {
        return $this->stateRepository->paginate($filters);
    }
}