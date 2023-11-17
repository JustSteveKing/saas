<?php

declare(strict_types=1);

namespace App\Http\Payloads\Auth;

use App\Enums\Identity\Provider;

final class OnboardingUser
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $username,
        public readonly string $email,
        public readonly null|string $avatar,
        public readonly Provider $provider,
        public readonly null|string $providerID,
        public readonly null|string $accessToken,
        public readonly string $password,
    ) {}

    /**
     * @param array{
     *     first_name: string,
     *     last_name: string,
     *     username: string,
     *     email: string,
     *     avatar: null|string,
     *     provider: Provider,
     *     provider_id: null|string,
     *     access_token: null|string,
     *     password: string,
     * } $data
     * @return OnboardingUser
     */
    public static function fromArray(array $data): OnboardingUser
    {
        return new OnboardingUser(
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            username: $data['username'],
            email: $data['email'],
            avatar: $data['avatar'],
            provider: $data['provider'],
            providerID: $data['provider_id'],
            accessToken: $data['access_token'],
            password: $data['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'provider' => $this->provider,
            'provider_id' => $this->providerID,
            'access_token' => $this->accessToken,
            'password' => $this->password,
        ];
    }
}
