<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Domain\Auth\Exceptions\IncorrectCredentialsException;
use App\Services\Domain\Auth\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LoginController extends BaseController
{
    private LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->loginService->login(
                $request->get('email'),
                $request->get('password'),
            );

            return $this->withSuccess([
                'message' => 'Logged in successfully!',
                'token' => $token
            ]);
        } catch (IncorrectCredentialsException $e) {
            return $this->withError(
                'Incorrect credentials!',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        } catch (Throwable $e) {
            Log::error('failed to login', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Internal error occurred while trying to login, please retry later!');
        }
    }
}
