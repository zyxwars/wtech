<!-- https://github.com/laravel/breeze/blob/2.x/stubs/default/resources/views/components/input-error.blade.php -->

@props(['messages'])

@if ($messages)
<ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
    @foreach ((array) $messages as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif