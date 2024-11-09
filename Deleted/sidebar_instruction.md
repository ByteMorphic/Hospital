I'll help you break down the sidebar into reusable Blade components for better organization and maintainability.



```blade
{{-- resources/views/components/layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? env('APP_NAME', 'HMS') }}</title>
    
    <!-- Styles -->
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('styles')
    
    <style>
        [x-cloak] { display: none !important; }
        
        .nav-link.active {
            @apply bg-indigo-50 text-indigo-600 border-l-4 border-indigo-600;
        }
        .dark .nav-link.active {
            @apply bg-indigo-900/20 text-indigo-400 border-indigo-400;
        }
        
        /* Preloader CSS */
        #preloader {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 9999;
            transition: background-color 0.3s ease;
        }

        .loader {
            display: flex;
            align-items: flex-end;
        }

        .dot {
            width: 15px;
            height: 15px;
            margin: 0 5px;
            border-radius: 50%;
            background-color: #3498db;
            animation: bounce 0.6s infinite alternate;
        }

        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes bounce {
            to { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <div x-data="{ 
        isSidebarOpen: false,
        isSidebarMinimized: false,
        isDark: window.matchMedia('(prefers-color-scheme: white)').matches,
        currentPath: window.location.pathname,
        activeDropdown: null
    }" class="min-h-screen">
    <div class="mb-5 pb-5"></div>
        <x-sidebar.mobile-header />
        <x-sidebar.main />


        <!-- Main Content -->
        <div :class="{'lg:pl-64': !isSidebarMinimized, 'lg:pl-20': isSidebarMinimized}"
             class="container flex-grow px-4 mx-auto transition-all duration-300"
             id="main-content" 
             style="display: none;">
            <div class="pt-10 lg:pt-0">
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot }}
                @endif
                <x-footer />
            </div>
        </div>
        
    </div>

    

    <!-- Scripts -->
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => preloader.style.display = 'none', 500);
            document.getElementById('main-content').style.display = 'block';
        });


        // Initialize dark mode based on system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.body.classList.add('dark');
        }
    </script>

    @stack('scripts')
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
            <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">STH (IPD)</span>
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
    <img x-show="!isSidebarMinimized" src="{{ asset('images/logo.png') }}" class="rounded h-7 w-auto"> 
    <span x-show="!isSidebarMinimized" class="text-lg font-semibold text-gray-800 dark:text-gray-200">STH</span>
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
        <x-sidebar.dropdown-item href="{{ route('medicines.create') }}" label="Add New Item" />
        <x-sidebar.dropdown-item href="{{ route('medicines.index') }}" label="View All Items" />
        <x-sidebar.dropdown-item href="{{ route('medicines.total') }}" label="Total" />
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="Generics"
        icon="M17.12 7.88l3.8 3.8c1.17 1.17 1.17 3.07 0 4.24l-3.2 3.2c-1.17 1.17-3.07 1.17-4.24 0l-3.8-3.8c-1.17-1.17-1.17-3.07 0-4.24l3.2-3.2c1.17-1.17 3.07-1.17 4.24 0zM6.88 16.12l-3.8-3.8c-1.17-1.17-1.17-3.07 0-4.24l3.2-3.2c1.17-1.17 3.07-1.17 4.24 0l3.8 3.8c1.17 1.17 1.17 3.07 0 4.24l-3.2 3.2c-1.17 1.17-3.07 1.17-4.24 0z"
        label="Generics">
        <x-sidebar.dropdown-item href="{{ route('generics.create') }}" label="New Generic" />
        <x-sidebar.dropdown-item href="{{ route('generics.index') }}" label="View All" />
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="Expense"
        icon="M5 3h14c1.104 0 2 .896 2 2v14c0 1.104-.896 2-2 2H5c-1.104 0-2-.896-2-2V5c0-1.104.896-2 2-2zM7 6h10M7 10h10M7 14h10M7 18h10"
        label="Expense">
        <x-sidebar.dropdown-item href="{{ route('expense.create') }}" label="Add New" />
        <x-sidebar.dropdown-item href="{{ route('expense.index') }}" label="History" />
        {{-- <x-sidebar.dropdown-item href="{{ route('expense.index') }}" label="Report" /> --}}
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="Wards"
        icon="M4 4h16a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V5a1 1 0 011-1zM7 7h10v10H7V7z"
        label="Wards">
        <x-sidebar.dropdown-item href="{{ route('wards.create') }}" label="Add New" />
        <x-sidebar.dropdown-item href="{{ route('wards.index') }}" label="View All Wards" />
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="Manage Account"
        icon="M12 12c2.485 0 4.5-2.015 4.5-4.5S14.485 3 12 3 7.5 5.015 7.5 7.5 9.515 12 12 12zm0 1.5c-3.05 0-9 1.525-9 4.5V21h18v-3c0-2.975-5.95-4.5-9-4.5z"
        label="Manage Account">
        <x-sidebar.dropdown-item href="{{ route('profile.show') }}" label="Profile" />
        <x-sidebar.dropdown-item href="{{ route('api-tokens.index') }}" label="Api Tokens" />
    </x-sidebar.dropdown>
    <x-sidebar.dropdown 
        name="{{ Auth::user()->currentTeam->name }}"
        icon="M12 14c3.314 0 6-2.686 6-6S15.314 2 12 2 6 4.686 6 8s2.686 6 6 6zM12 14c-4.418 0-8 2.686-8 6v2h16v-2c0-3.314-3.582-6-8-6z"
        label="Manage Team">
        <x-sidebar.dropdown-item href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" label="Team Setting" />
        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <x-sidebar.dropdown-item href="{{ route('teams.create') }}" label="Create New Team" />
        @endcan
        @if (Auth::user()->allTeams()->count() > 1)
        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Switch Teams') }}
        </div>
        @foreach (Auth::user()->allTeams() as $team)
            <x-sidebar.team-switch :team="$team" />
        @endforeach
        @endif
    </x-sidebar.dropdown>




    {{-- Add other dropdowns similarly --}}
    
    <x-sidebar.nav-link 
        href="/settings" 
        icon="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"
        label="Settings" />
        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
        
            <button type="submit" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 group">
                <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span x-show="!isSidebarMinimized">Logout</span>
            </button>
        </form>
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
