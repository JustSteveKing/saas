<form wire:submit.prevent="submit" class="space-y-6">

    <div>
        <x-label for="first_name" :value="__('First Name')" />
        <div class="mt-2">
            <x-input wire:model="form.firstName" id="first_name" class="block mt-1 w-full" type="text" name="first_name" required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('form.firstName')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-label for="last_name" :value="__('Last Name')" />
        <div class="mt-2">
            <x-input wire:model="form.lastName" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required autocomplete="off" />
            <x-input-error :messages="$errors->get('form.lastName')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-label for="email" :value="__('Email Address')" />
        <div class="mt-2">
            <x-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="off" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-label for="username" :value="__('Username')" />
        <div class="mt-2">
            <x-input wire:model="form.username" id="username" class="block mt-1 w-full" type="text" name="username" required autocomplete="off" />
            <x-input-error :messages="$errors->get('form.username')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-label for="password" :value="__('Password')" />
        <div class="mt-2">
            <x-input
                wire:model="form.password"
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-button theme="primary">
            {{ __('Finish Onboarding') }}
        </x-button>
    </div>
</form>
