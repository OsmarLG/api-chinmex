<?php

namespace App\Actions\State;

use App\Repositories\Contracts\StateRepositoryInterface;

class DeleteStateAction
{
    protected StateRepositoryInterface $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Execute the delete state action
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function execute(int $id): bool
    {
        $state = $this->stateRepository->find($id);

        if (!$state) {
            throw new \Exception('State not found');
        }

        return $this->stateRepository->delete($state);
    }
}