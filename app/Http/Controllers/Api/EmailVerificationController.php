<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\JsonResponse;

class EmailVerificationController extends ApiController
{
    /**
     * Verify email using a signed URL.
     * Route name must be 'verification.verify'.
     */
    public function verify(Request $request, int $id, string $hash)
    {
        // Validate signed URL
        if (!URL::hasValidSignature($request)) {
            return response()->json([
                'status' => false,
                'message' => 'Enlace de verificación inválido o expirado.',
            ], 403);
        }

        $user = User::findOrFail($id);

        // Validate hash
        if (! hash_equals($hash, sha1($user->getEmailForVerification()))) {
            return response()->json([
                'status' => false,
                'message' => 'Hash de verificación inválido.',
            ], 403);
        }

        $already = $user->hasVerifiedEmail();
        if (!$already) {
            $user->markEmailAsVerified();
        }

        $frontend = rtrim(config('app.frontend_url', env('FRONTEND_URL', env('APP_FRONTEND_URL', 'http://localhost:3000'))), '/');
        $status = $already ? 'already_verified' : 'verified';
        $redirectUrl = $frontend . '/email/verify?status=' . $status . '&email=' . urlencode($user->email);

        return redirect()->to($redirectUrl);
    }

    /**
     * Resend verification email.
     * Accepts: { email: string }
     */
    public function resend(Request $request): JsonResponse
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
                    'message' => 'El correo ya estaba verificado.',
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
