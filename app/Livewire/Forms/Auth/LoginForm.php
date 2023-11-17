<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Auth;

use Livewire\Attributes\Rule;
use Livewire\Form;

final class LoginForm extends Form
{
    #[Rule(['required','min:2','max:255','exists:users,email'])]
    public string $email;

    #[Rule(['required','min:2','max:255'])]
    public string $password;

    public function submit(): void
    {
        $this->validate();
    }
}
