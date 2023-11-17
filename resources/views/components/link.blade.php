@props([
    'href',
    'title',
])

<a wire:navigate title="{{ $title }}" href="{{ route($href) }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
    {{ $slot }}
</a>
