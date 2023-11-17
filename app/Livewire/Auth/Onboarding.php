<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Enums\Identity\Provider;
use App\Livewire\Forms\Auth\OnboardingForm;
use App\Services\AuthenticationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

final class Onboarding extends Component
{
    /**
     * @var array{
     *     name: string,
     *     email: string,
     *     username: string,
     *     avatar: string,
     *     provider: Provider,
     *     provider_id: int|string,
     *     access_token: string
     * }
     */
    public array $payload;

    public OnboardingForm $form;

    public function mount(): void
    {
        // @todo Handle Login and Registration
        $this->payload = Session::get('payload');

        $this->form->firstName = Str::of(
            string: $this->payload['name'],
        )->beforeLast(' ')->toString();
        $this->form->lastName = Str::of(
            string: $this->payload['name'],
        )->afterLast(' ')->toString();
        $this->form->email = $this->payload['email'];
        $this->form->username = $this->payload['username'];
        $this->form->avatar = $this->payload['avatar'];
        $this->form->provider = $this->payload['provider']->value;
        $this->form->providerID = (string) $this->payload['provider_id'];
        $this->form->accessToken = $this->payload['access_token'];
    }

    public function submit(AuthenticationService $service): void
    {
        $this->form->submit();

        $service->registerUser(
            payload: $this->form->toPayload(),
        );

        $service->authenticate(
            email: $this->form->email,
            password: $this->form->password,
        );

        $this->redirect(
            url: route('pages:dashboard:index'),
        );
    }

    public function render(): View
    {
        return view('livewire.auth.onboarding');
    }
}
