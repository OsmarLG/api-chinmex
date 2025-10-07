<?php

namespace App\Actions\State;

use App\Models\State;
use App\Repositories\Contracts\StateRepositoryInterface;

class CreateStateAction
{
    protected StateRepositoryInterface $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Execute the create state action
     *
     * @param array $data
     * @return State
     */
    public function execute(array $data): State
    {
        return $this->stateRepository->create($data);
    }
}