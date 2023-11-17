<?php

declare(strict_types=1);

namespace App\Enums\Account;

enum Status: string
{
    case Onboarding = 'onboarding';
    case Verified = 'verified';
}
