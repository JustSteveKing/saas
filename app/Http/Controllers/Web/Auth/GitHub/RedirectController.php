<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth\GitHub;

use App\Enums\Identity\Provider;
use Illuminate\Http\Request;
use Laravel\Socialite\SocialiteManager;

final readonly class RedirectController
{
    public function __construct(
        private SocialiteManager $manager,
    ) {
    }

    public function __invoke(Request $request)
    {
        return $this->manager->driver(
            driver: Provider::Github->value,
        )->redirect();
    }
}
