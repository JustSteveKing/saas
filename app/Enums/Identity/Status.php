<?php

declare(strict_types=1);

namespace App\Enums\Identity;

enum Status: string
{
    case Onboarding = 'onboarding';
    case Verified = 'verified';
}
