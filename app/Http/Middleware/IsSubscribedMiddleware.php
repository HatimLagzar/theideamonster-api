<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSubscribedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = $request->user();
        if ($user && !$user->subscribed()) {
            if ($request->expectsJson()) {
                return response([
                    'message' => 'You are not subscribed!',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return redirect()->back()
                ->with('error', 'Unauthorized feature! Please subscribe to use this feature');
        }

        return $next($request);
    }
}
