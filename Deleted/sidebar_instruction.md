I'll help you break down the sidebar into reusable Blade components for better organization and maintainability.



```blade
{{-- resources/views/components/layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'HMS' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .nav-link.active {
            @apply bg-indigo-50 text-indigo-600 border-l-4 border-indigo-600;
        }
        .dark .nav-link.active {
            @apply bg-indigo-900/20 text-indigo-400 border-indigo-400;
        }
    </style>
</head>
<body>
    <div x-data="{ 
        isSidebarOpen: false,
        isSidebarMinimized: false,
        isDark: false,
        currentPath: window.location.pathname,
        activeDropdown: null
    }" class="min-h-screen">
        <x-sidebar.mobile-header />
        <x-sidebar.main />
        
        <!-- Main Content -->
        <div :class="{'lg:pl-64': !isSidebarMinimized, 'lg:pl-20': isSidebarMinimized}"
             class="transition-all duration-300">
            <div class="pt-16 lg:pt-0">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>

{{-- resources/views/components/sidebar/mobile-header.blade.php --}}
<div class="lg:hidden bg-white dark:bg-gray-800 border-b dark:border-gray-700 fixed w-full top-0 z-30">
    <div class="flex items-center justify-between h-16 px-4">
        <div class="flex items-center space-x-3">
            <button @click="isSidebarOpen = !isSidebarOpen" class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">HMS</span>
        </div>
    </div>
</div>

{{-- resources/views/components/sidebar/main.blade.php --}}
<div :class="{
        'translate-x-0': isSidebarOpen,
        '-translate-x-full': !isSidebarOpen,
        'w-64': !isSidebarMinimized,
        'w-20': isSidebarMinimized
     }" 
     class="fixed inset-y-0 left-0 z-20 bg-white dark:bg-gray-800 border-r dark:border-gray-700 transform transition-all duration-300 lg:translate-x-0">
    
    <x-sidebar.header />
    <x-sidebar.navigation />
</div>

{{-- resources/views/components/sidebar/header.blade.php --}}
<div class="flex items-center justify-between h-16 px-4 border-b dark:border-gray-700">
    <span x-show="!isSidebarMinimized" class="text-lg font-semibold text-gray-800 dark:text-gray-200">HMS</span>
    <button @click="isSidebarMinimized = !isSidebarMinimized" 
            class="hidden lg:block p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
        <svg x-show="!isSidebarMinimized" class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
        </svg>
        <svg x-show="isSidebarMinimized" class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
        </svg>
    </button>
</div>

{{-- resources/views/components/sidebar/navigation.blade.php --}}
<nav class="px-3 py-4 space-y-2 overflow-y-auto">
    <x-sidebar.nav-link 
        href="/dashboard" 
        icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
        label="Dashboard" />
        
    <x-sidebar.dropdown 
        name="medicine"
        icon="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
        label="Medicine">
        <x-sidebar.dropdown-item href="{{ route('medicines.create') }}" label="Add New" />
        <x-sidebar.dropdown-item href="{{ route('medicines.index') }}" label="View All" />
    </x-sidebar.dropdown>

    {{-- Add other dropdowns similarly --}}
    
    <x-sidebar.nav-link 
        href="/settings" 
        icon="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"
        label="Settings" />
</nav>

{{-- resources/views/components/sidebar/nav-link.blade.php --}}
@props(['href', 'icon', 'label'])

<a href="{{ $href }}" 
   :class="{'active': currentPath === '{{ $href }}'}"
   class="nav-link flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
    <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
    </svg>
    <span x-show="!isSidebarMinimized">{{ $label }}</span>
</a>

{{-- resources/views/components/sidebar/dropdown.blade.php --}}
@props(['name', 'icon', 'label'])

<div x-data="{ isOpen: false }" class="relative">
    <button @click="if (!isSidebarMinimized) activeDropdown = activeDropdown === '{{ $name }}' ? null : '{{ $name }}'"
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

{{-- resources/views/components/sidebar/dropdown-item.blade.php --}}
@props(['href', 'label'])

<a href="{{ $href }}" 
   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
    {{ $label }}
</a>

```

To use these components in your Laravel application:

1. Create the component files in your `resources/views/components` directory following the structure above.

2. You can now use the layout in your blade views like this:

```blade
{{-- resources/views/dashboard.blade.php --}}
<x-layout>
    <x-slot name="title">
        Dashboard - HMS
    </x-slot>
    
    <div class="p-6">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <!-- Your dashboard content -->
    </div>
</x-layout>
```

The benefits of this component-based approach include:

1. **Reusability**: Each component can be reused across different views
2. **Maintainability**: Easier to update and modify individual components
3. **Organization**: Clear separation of concerns
4. **Flexibility**: Easy to add new menu items or modify existing ones

To add a new menu item with a dropdown:

```blade
<x-sidebar.dropdown 
    name="new-section"
    icon="[your-svg-path]"
    label="New Section">
    <x-sidebar.dropdown-item href="/new-section/create" label="Add New" />
    <x-sidebar.dropdown-item href="/new-section/list" label="View All" />
</x-sidebar.dropdown>
```

Or a simple navigation link:

```blade
<x-sidebar.nav-link 
    href="/reports" 
    icon="[your-svg-path]"
    label="Reports" />
```

Would you like me to explain any part in more detail or make any adjustments to the components?