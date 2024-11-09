@props(['name', 'icon', 'label'])
<div x-data="{ 
    isOpen: false,
    activeDropdown: null,
    toggleDropdown() {
        if (!this.isSidebarMinimized) {
            this.activeDropdown = this.activeDropdown === '{{ $name }}' ? null : '{{ $name }}';
        }
    }
}" 
    class="relative">
    
    <button @click="toggleDropdown()"
            class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
        </svg>
        <template x-if="!isSidebarMinimized">
            <span class="flex-1 text-left">{{ $label }}</span>
        </template>
        <svg x-show="!isSidebarMinimized"
             :class="{'rotate-180': activeDropdown === '{{ $name }}'}"
             class="w-4 h-4 ml-auto transform transition-transform duration-200"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    
    <div x-show="!isSidebarMinimized && activeDropdown === '{{ $name }}'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="mt-1 pl-11 space-y-1">
        {{ $slot }}
    </div>
</div>