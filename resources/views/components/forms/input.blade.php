@props(['type', 'name', 'value', 'required'])

<input 
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ $value }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge([
        'class' => 'w-full p-2 border border-indigo-500 rounded-md dark:bg-gray-900 dark:text-slate-300 focus:ring focus:ring-indigo-400 mt-1'
    ]) }}
    autocomplete="on"
/>