<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Throwable;

class ResetPasswordController extends BaseController
{
    public function __invoke(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ? $this->withSuccess(['message' => __($status)])
                : $this->withError(__($status));
        } catch (Throwable $e) {
            Log::error('failed to reset password', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
