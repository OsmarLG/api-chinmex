<?php

namespace App\Services;

use App\Actions\State\GetAllStatesAction;
use App\Actions\State\GetStateByIdAction;
use App\Actions\State\CreateStateAction;
use App\Actions\State\UpdateStateAction;
use App\Actions\State\DeleteStateAction;
use App\Models\State;
use Illuminate\Pagination\LengthAwarePaginator;

class StateService extends BaseService
{
    /**
     * Get all states with optional filtering and pagination
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllStates(array $filters = []): LengthAwarePaginator
    {
        return $this->callAction(GetAllStatesAction::class, $filters);
    }

    /**
     * Get a specific state by ID
     *
     * @param int $id
     * @return State
     * @throws \Exception
     */
    public function getStateById(int $id): State
    {
        return $this->callAction(GetStateByIdAction::class, $id);
    }

    /**
     * Create a new state
     *
     * @param array $data
     * @return State
     */
    public function createState(array $data): State
    {
        return $this->callAction(CreateStateAction::class, $data);
    }

    /**
     * Update an existing state
     *
     * @param int $id
     * @param array $data
     * @return State
     * @throws \Exception
     */
    public function updateState(int $id, array $data): State
    {
        return $this->callAction(UpdateStateAction::class, $id, $data);
    }

    /**
     * Delete a state
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function deleteState(int $id): bool
    {
        return $this->callAction(DeleteStateAction::class, $id);
    }
}