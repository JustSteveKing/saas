<form wire:submit.prevent="submit" class="space-y-6">
    <div>
        <x-label for="email" :value="__('Email Address')" />
        <div class="mt-2">
            <x-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
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

    <div class="flex items-center justify-between">

        <div class="text-sm leading-6">
            <x-link href="pages:auth:login" title="Forgot Password">
                Forgot password?
            </x-link>
        </div>
    </div>

    <div>
        <x-button theme="primary">
            {{ __('Log in') }}
        </x-button>
    </div>
</form>
