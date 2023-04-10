@props(['href', 'svg', 'name'])

<a href="{{ route('' . $href . '') }}" class="{{ setActiveRoutePt1($href) }}">
    <span aria-hidden="true" class="{{ setActiveRoutePt2($href) }}">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $svg }}" />
        </svg>
    </span>
    <span>{{ $name }}</span>
</a>
