<?php

namespace App\Http\Controllers\Api\Subscriptions;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Stripe\Price;
use Stripe\Stripe;
use Throwable;

class CreatePaymentIntentController extends BaseController
{
    public function __invoke(): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            $customer = $user->createOrGetStripeCustomer([
                'name'  => $user->getFullName(),
                'email' => $user->getEmail(),
            ]);

            $intent = $user->createSetupIntent([
                'customer' => $customer->id,
            ]);

            return $this->withSuccess([
                'message'      => 'Payment intent created successfully!',
                'clientSecret' => $intent->client_secret
            ]);
        } catch (Throwable $e) {
            Log::error('failed to create payment intent', [
                'error_message' => $e->getMessage()
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
