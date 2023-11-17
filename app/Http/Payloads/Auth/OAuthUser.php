<?php

declare(strict_types=1);

namespace App\Http\Payloads\Auth;

use App\Enums\Identity\Provider;
use Laravel\Socialite\Two\User;

final readonly class OAuthUser
{
    /**
     * @param string $name
     * @param string $email
     * @param string $username
     * @param string $avatar
     * @param Provider $provider
     * @param int|string $providerID
     * @param string $accessToken
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $username,
        public string $avatar,
        public Provider $provider,
        public int|string $providerID,
        public string $accessToken,
    ) {
    }

    /**
     * @param User $user
     * @param Provider $provider
     * @return OAuthUser
     */
    public static function fromUser(User $user, Provider $provider): OAuthUser
    {
        return new OAuthUser(
            name: $user->getName(),
            email: $user->getEmail(),
            username: $user->getNickname(),
            avatar: $user->getAvatar(),
            provider: $provider,
            providerID: $user->getId(),
            accessToken: $user->token,
        );
    }

    /**
     * @return array{
     *      name: string,
     *      email: string,
     *      username: string,
     *      avatar: string,
     *      provider: Provider,
     *      provider_id: int|string,
     *      access_token: string
     *  }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'avatar' => $this->avatar,
            'provider' => $this->provider,
            'provider_id' => $this->providerID,
            'access_token' => $this->accessToken,
        ];
    }
}
