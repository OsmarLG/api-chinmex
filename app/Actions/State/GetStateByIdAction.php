<?php

namespace App\Actions\State;

use App\Models\State;
use App\Repositories\Contracts\StateRepositoryInterface;

class GetStateByIdAction
{
    protected StateRepositoryInterface $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Execute the get state by id action
     *
     * @param int $id
     * @return State
     * @throws \Exception
     */
    public function execute(int $id): State
    {
        $state = $this->stateRepository->find($id);

        if (!$state) {
            throw new \Exception('State not found');
        }

        return $state;
    }
}