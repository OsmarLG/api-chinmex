<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Notifications\WelcomeNotification;

class AuthController extends ApiController
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login
     *
     * Autenticación con email o username.
     * Devuelve el usuario autenticado y el token de acceso.
     *
     * @response AuthResource
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $payload = $this->authService->login($request->validated());
            return new AuthResource($payload);
        }, 'Autenticación exitosa');
    }

    /**
     * Register
     *
     * Registro de usuario con email y password. El username es opcional.
     * Devuelve el usuario creado y el token.
     *
     * @response AuthResource
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $payload = $this->authService->register($request->validated());
            return new AuthResource($payload);
        }, 'Registro exitoso', 201);
    }

    /**
     * Forgot Password
     *
     * Envía un enlace de restablecimiento de contraseña al email.
     *
     * @response {"status": true, "message": "Correo de restablecimiento enviado"}
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            return $this->authService->forgotPassword($request->validated());
        }, 'Correo de restablecimiento enviado');
    }

    /**
     * Reset Password
     *
     * Restablece la contraseña usando el token de recuperación.
     *
     * @response {"status": true, "message": "Contraseña restablecida correctamente"}
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            return $this->authService->resetPassword($request->validated());
        }, 'Contraseña restablecida correctamente');
    }

    /**
     * Verify Email (via signed URL)
     *
     * Redirige al frontend después de verificar: FRONTEND_URL/email/verify?status=verified|already_verified
     * No requiere estar autenticado; valida la firma y el hash del email.
     */
    public function verifyEmail(Request $request, int $id, string $hash)
    {
        // Validate signed URL
        if (!URL::hasValidSignature($request)) {
            return response()->json([
                'status' => false,
                'message' => 'Enlace de verificación inválido o expirado.',
            ], 403);
        }

        $user = User::findOrFail($id);

        // Validate the hash matches the user's email
        if (! hash_equals($hash, sha1($user->getEmailForVerification()))) {
            return response()->json([
                'status' => false,
                'message' => 'Hash de verificación inválido.',
            ], 403);
        }

        $already = $user->hasVerifiedEmail();
        if (!$already) {
            $user->markEmailAsVerified();
            // Send welcome notification after successful verification
            if (method_exists($user, 'notify')) {
                $user->notify(new WelcomeNotification());
            }
        }

        $frontend = rtrim(config('app.frontend_url', env('FRONTEND_URL', env('APP_FRONTEND_URL', 'http://localhost:3000'))), '/');
        $status = $already ? 'already_verified' : 'verified';
        // Unify final redirect to frontend login so it can prefill email
        $redirectUrl = $frontend . '/login?status=' . $status . '&email=' . urlencode($user->email);

        return redirect()->to($redirectUrl);
    }

    /**
     * Resend verification email.
     *
     * Body: { email: string }
     */
    public function resendVerification(Request $request): JsonResponse
    {
        return $this->handleRequest(function () use ($request) {
            $request->validate([
                'email' => 'required|email',
            ]);

            /** @var User|null $user */
            $user = User::where('email', $request->input('email'))->first();

            if (!$user) {
                return [
                    'status' => true,
                    'message' => 'Si el correo existe, se enviará un enlace de verificación.',
                ];
            }

            if ($user->hasVerifiedEmail()) {
                return [
                    'status' => true,
                    'message' => 'El correo ya está verificado.',
                ];
            }

            $user->sendEmailVerificationNotification();

            return [
                'status' => true,
                'message' => 'Se envió el enlace de verificación a tu correo.',
            ];
        });
    }
}
