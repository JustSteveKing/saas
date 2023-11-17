<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class OnboardingMiddleware
{
    /**
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return new RedirectResponse(
                url: route('pages:auth:login'),
            );
        }

        if (! Auth::user()?->onboarded()) {
            return new RedirectResponse(
                url: route('pages:auth:onboarding'),
            );
        }

        return $next($request);
    }
}
