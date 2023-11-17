<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Identity\Provider;
use App\Enums\Identity\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $social = $this->faker->boolean();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => $social ? null : Hash::make('password'),
            'remember_token' => Str::random(10),
            'avatar' => $this->faker->imageUrl(),
            'status' => Status::Onboarding,
            'provider' => $social ? Provider::Github : Provider::Email,
            'provider_id' => $social ? $this->faker->uuid() : null,
            'access_token' => $social ? Str::random() : null,
            'email_verified_at' => now(),
        ];
    }

    public function unverified(): UserFactory
    {
        return $this->state(state: fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }
}
