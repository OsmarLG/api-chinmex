<?php

namespace App\Actions\User;

use App\Repositories\Contracts\UserRepositoryInterface;

class RestoreUserAction
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Restore a soft-deleted user by ID.
     */
    public function execute(int $id): bool
    {
        $restored = $this->userRepository->restore($id);
        if (!$restored) {
            throw new \Exception('Usuario no encontrado', 404);
        }
        return $restored;
    }
}
