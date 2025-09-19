<?php

namespace App\Pipelines;

use App\Actions\User\CreateUserAction;
use App\Models\User;
use Illuminate\Contracts\Pipeline\Pipeline as PipelineContract;

class RegisterUserPipeline
{
    protected CreateUserAction $createUserAction;

    public function __construct(CreateUserAction $createUserAction)
    {
        $this->createUserAction = $createUserAction;
    }

    /**
     * Execute the registration pipeline: create user, assign role 'user', send welcome mail.
     *
     * @param array{name:string,username?:string,email:string,password:string} $data
     * @return User
     */
    public function execute(array $data): User
    {
        // 1) Create user
        $user = $this->createUserAction->execute($data);

        // 2) Assign default role 'user' (spatie/laravel-permission)
        if (method_exists($user, 'assignRole')) {
            $user->assignRole('user');
        }

        // 3) Send welcome notification/email
        // Moved to email verification step (AuthController::verifyEmail)

        // 4) Send email verification link
        if (method_exists($user, 'sendEmailVerificationNotification')) {
            $user->sendEmailVerificationNotification();
        }

        return $user;
    }
}
