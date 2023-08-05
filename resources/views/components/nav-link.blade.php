@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-blue'
            : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} style="text-transform: uppercase; font-weight: 600; font-size: 17px;">
    {{ $slot }}
</a>
