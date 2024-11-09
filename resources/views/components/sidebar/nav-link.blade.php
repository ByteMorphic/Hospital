<<<<<<< HEAD
@props(['href', 'icon', 'label'])

@php
$isActive = request()->is(trim($href, '/') . '*');
@endphp

<a href="{{ $href }}" 
   class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ 
       $isActive 
           ? 'bg-gray-900 text-white' 
           : 'text-gray-300 hover:bg-gray-700 hover:text-white'
   }}"
   aria-current="{{ $isActive ? 'page' : 'false' }}">
=======
<a href="{{ $href }}" 
   :class="{'active': request()->is('{{ $href }}')}"
   class="nav-link flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
>>>>>>> parent of 4505ed4 (fix: dropdown in sidebar in not opening)
    <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
    </svg>
    <span x-show="!isSidebarMinimized">{{ $label }}</span>
</a>