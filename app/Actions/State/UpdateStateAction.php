<?php

namespace App\Actions\State;

use App\Models\State;
use App\Repositories\Contracts\StateRepositoryInterface;

class UpdateStateAction
{
    protected StateRepositoryInterface $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Execute the update state action
     *
     * @param int $id
     * @param array $data
     * @return State
     * @throws \Exception
     */
    public function execute(int $id, array $data): State
    {
        $state = $this->stateRepository->find($id);

        if (!$state) {
            throw new \Exception('State not found');
        }

        return $this->stateRepository->update($state, $data);
    }
}