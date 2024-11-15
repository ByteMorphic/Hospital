@props(['href', 'icon', 'label'])

@php
$isActive = request()->is(trim($href, '/') . '*');
@endphp

<a href="{{ $href }}"
   class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-white {{
       $isActive
           ? 'bg-gray-900 text-white'
           : 'text-gray-800 hover:bg-gray-700 hover:text-white'
   }}"
   aria-current="{{ $isActive ? 'page' : 'false' }}">
    <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
    </svg>
    <span x-show="!isSidebarMinimized">{{ $label }}</span>
</a>
