@props(['required' => false])

<label class="block mt-1 font-medium">
    {{ $slot }}
    <span
        @class([
            'text-danger-500',
            'hidden' => !$required
        ])
    >*</span>
</label>