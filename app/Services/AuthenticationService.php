<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Identity\Status;
use App\Http\Payloads\Auth\OAuthUser;
use App\Http\Payloads\Auth\OnboardingUser;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

final readonly class AuthenticationService
{
    public function __construct(
        private AuthManager $auth,
        private DatabaseManager $database,
    ) {
    }

    public function handleOauthLogin(OAuthUser $payload): RedirectResponse
    {
        Session::put('payload', $payload->toArray());

        return new RedirectResponse(
            url: route('pages:auth:onboarding'),
        );
    }

    public function registerUser(OnboardingUser $payload): User
    {
        return $this->database->transaction(
            callback: fn () => User::query()->create(
                attributes: [
                    ...$payload->toArray(),
                    'status' => Status::Verified,
                ],
            ),
        );
    }

    public function authenticate(string $email, string $password): bool
    {
        return $this->auth->attempt(
            credentials: [
                'email' => $email,
                'password' => $password,
            ],
        );
    }
}
