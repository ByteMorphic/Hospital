@props(['href', 'icon', 'label'])

<a href="{{ $href }}" 
   :class="{'active': currentPath === '{{ $href }}'}"
   class="nav-link flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
    <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
    </svg>
    <span x-show="!isSidebarMinimized">{{ $label }}</span>
</a>