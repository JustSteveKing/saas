<?php

declare(strict_types=1);

namespace App\Enums\Identity;

enum Provider: string
{
    case Github = 'github';
    case Email = 'email';
}
