<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Account\Status;
use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'status' => Status::Onboarding,
            'user_id' => User::factory(),
        ];
    }
}
