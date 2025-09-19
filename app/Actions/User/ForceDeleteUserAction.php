<?php

namespace App\Actions\User;

use App\Repositories\Contracts\UserRepositoryInterface;

class ForceDeleteUserAction
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Permanently delete a user by ID.
     */
    public function execute(int $id): bool
    {
        $deleted = $this->userRepository->forceDelete($id);
        if (!$deleted) {
            throw new \Exception('Usuario no encontrado', 404);
        }
        return $deleted;
    }
}
