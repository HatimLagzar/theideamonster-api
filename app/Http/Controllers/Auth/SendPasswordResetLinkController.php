<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Mail\PasswordResetLinkMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Throwable;

class SendPasswordResetLinkController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email'),
                function (User $user, string $token) {
                    Mail::to($user)->queue(new PasswordResetLinkMail($user, $token));
                }
            );

            return $status === Password::RESET_LINK_SENT
                ? $this->withSuccess(['message' => __($status)])
                : $this->withError(__($status));
        } catch (Throwable $e) {
            Log::error('failed to send password reset link', [
                'error_message' => $e->getMessage()
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
