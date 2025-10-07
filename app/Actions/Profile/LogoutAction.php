<?php

namespace App\Actions\Profile;


class LogoutAction
{
    /**
     * Execute logout and return status.
     *
     * @return array{status: string}
     */
    public function execute(): array
    {
        auth()->user()->currentAccessToken()->delete();

        return [
            'status' => 'Sesión cerrada exitosamente',
        ];
    }
}