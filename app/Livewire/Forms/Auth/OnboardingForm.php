<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Auth;

use App\Enums\Identity\Provider;
use App\Http\Payloads\Auth\OnboardingUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Form;

final class OnboardingForm extends Form
{
    #[Rule(['required','string','min:2','max:255'])]
    public string $firstName;

    #[Rule(['required','string','min:2','max:255'])]
    public string $lastName;

    #[Rule(['required','string','min:2','max:255','unique:users,email'])]
    public string $username;

    #[Rule(['required','email','max:255','unique:users,email'])]
    public string $email;

    #[Rule(['nullable','string','max:255'])]
    public string $avatar;

    public string $provider;

    #[Rule(['nullable','max:255'])]
    public string $providerID;

    #[Rule(['nullable','string'])]
    public string $accessToken;

    #[Rule(['required','string','min:5','max:255'])]
    public string $password;

    public function submit(): void
    {
        $this->validate();
    }

    public function toPayload(): OnboardingUser
    {
        return OnboardingUser::fromArray(
            data: [
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'username' => $this->username,
                'email' => $this->email,
                'avatar' => $this->avatar,
                'provider' => Provider::tryFrom(
                    value: $this->provider,
                ),
                'provider_id' => $this->providerID,
                'access_token' => $this->accessToken,
                'password' => Hash::make(
                    value: $this->password,
                ),
            ],
        );
    }
}
