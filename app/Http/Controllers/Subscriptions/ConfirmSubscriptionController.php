<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Stripe\SetupIntent;
use Stripe\Stripe;
use Throwable;

class ConfirmSubscriptionController extends BaseController
{
    public function __invoke(string $setupIntentId): JsonResponse
    {
        try {
            $user = $this->getAuthUser();

            if ($user->subscribed()) {
                return $this->withError('You are already subscribed to our services.');
            }

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $setupIntent = SetupIntent::retrieve($setupIntentId);
            $paymentMethodId = $setupIntent->payment_method;

            $user->newSubscription('default', env('SUBSCRIPTION_STRIPE_PRODUCT_ID'))
                ->create($paymentMethodId);

            return $this->withSuccess([
                'message' => 'You did subscribe successfully.'
            ]);
        } catch (Throwable $e) {
            Log::error('failed to confirm subscription', [
                'error_message' => $e->getMessage(),
            ]);

            return $this->withError('Error occurred, please retry later!');
        }
    }
}
