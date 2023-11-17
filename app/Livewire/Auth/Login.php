<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Livewire\Forms\Auth\LoginForm;
use App\Services\AuthenticationService;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

final class Login extends Component
{
    use WithRateLimiting;

    public LoginForm $form;

    public function submit(AuthenticationService $service): RedirectResponse|Redirector
    {
        $this->form->submit();
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
        return view('livewire.auth.login');
    }
}
