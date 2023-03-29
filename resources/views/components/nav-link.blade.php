@props(['active'])

@php
    $classes = $active ?? false ? 'nav-link text-white bg-gradient-primary' : 'nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
