<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\GitHub;

use App\Enums\Identity\Provider;
use App\Http\Payloads\Auth\OAuthUser;
use App\Services\AuthenticationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\SocialiteManager;

final readonly class CallbackController
{
    public function __construct(
        private SocialiteManager $manager,
        private AuthenticationService $service,
    ) {
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $user = $this->manager->driver(
            driver: Provider::Github->value,
        )->user();

        return $this->service->handleOauthLogin(
            payload: OAuthUser::fromUser(
                user: $user,
                provider: Provider::Github,
            ),
        );
    }
}
