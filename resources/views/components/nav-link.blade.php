@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-blue'
            : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
