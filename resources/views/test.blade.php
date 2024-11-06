<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collapsible Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<style>
    [x-cloak] { display: none !important; }
    .nav-link.active {
        @apply bg-indigo-50 text-indigo-600 border-l-4 border-indigo-600;
    }
    .dark .nav-link.active {
        @apply bg-indigo-900/20 text-indigo-400 border-indigo-400;
    }
</style>

<body>
<div x-data="{ 
    isSidebarOpen: false,
    isSidebarMinimized: false,
    isDark: false,
    currentPath: window.location.pathname,
    activeDropdown: null
}" class="min-h-screen">
    <!-- Mobile Top Bar -->
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

    <!-- Sidebar -->
    <div :class="{
            'translate-x-0': isSidebarOpen,
            '-translate-x-full': !isSidebarOpen,
            'w-64': !isSidebarMinimized,
            'w-20': isSidebarMinimized
         }" 
         class="fixed inset-y-0 left-0 z-20 bg-white dark:bg-gray-800 border-r dark:border-gray-700 transform transition-all duration-300 lg:translate-x-0">
        
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-16 px-4 border-b dark:border-gray-700">
            <span x-show="!isSidebarMinimized" class="text-lg font-semibold text-gray-800 dark:text-gray-200">HMS</span>
            <!-- Toggle Minimize Button (Desktop Only) -->
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

        <!-- Navigation Links -->
        <nav class="px-3 py-4 space-y-2 overflow-y-auto">
            <!-- Dashboard -->
            <a href="/dashboard" 
               :class="{'active': currentPath === '/dashboard'}"
               class="nav-link flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="!isSidebarMinimized">Dashboard</span>
            </a>

<!-- Medicine Dropdown -->
<div x-data="{ isOpen: false }" class="relative">
    <button @click="if (!isSidebarMinimized) activeDropdown = activeDropdown === 'medicine' ? null : 'medicine'"
            class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <svg class="w-5 h-5" :class="{'mr-3': !isSidebarMinimized}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
        </svg>
        <template x-if="!isSidebarMinimized">
            <span class="flex-1 text-left">Medicine</span>
        </template>
        <svg x-show="!isSidebarMinimized" 
             :class="{'rotate-180': activeDropdown === 'medicine'}" 
             class="w-4 h-4 ml-auto transform transition-transform duration-200" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <div x-show="!isSidebarMinimized && activeDropdown === 'medicine'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="mt-1 pl-11 space-y-1">
        <a href="{{ route('medicines.create') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add New</a>
        <a href="{{ route('medicines.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">View All</a>
    </div>
</div>

            <!-- Wards Dropdown -->
            <div x-data="{ isOpen: false }" class="relative">
                <button @click="activeDropdown = activeDropdown === 'wards' ? null : 'wards'"
                        class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Wards
                    <svg :class="{'rotate-180': activeDropdown === 'wards'}" 
                         class="w-4 h-4 ml-auto transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="activeDropdown === 'wards'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-1 pl-11 space-y-1">
                    <a href="{{ route('wards.create') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add New</a>
                    <a href="{{ route('wards.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">View All</a>
                </div>
            </div>

            <!-- Expense Dropdown -->
            <div x-data="{ isOpen: false }" class="relative">
                <button @click="activeDropdown = activeDropdown === 'expense' ? null : 'expense'"
                        class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Expense
                    <svg :class="{'rotate-180': activeDropdown === 'expense'}" 
                         class="w-4 h-4 ml-auto transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="activeDropdown === 'expense'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-1 pl-11 space-y-1">
                    <a href="{{ route('expense.create') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add New</a>
                    <a href="{{ route('expense.index') }}" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">View All</a>
                    <a href="/expense/reports" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Reports</a>
                </div>
            </div>
{{-- 
            <!-- Patients Dropdown -->
            <div x-data="{ isOpen: false }" class="relative">
                <button @click="activeDropdown = activeDropdown === 'patients' ? null : 'patients'"
                        class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Patients
                    <svg :class="{'rotate-180': activeDropdown === 'patients'}" 
                         class="w-4 h-4 ml-auto transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="activeDropdown === 'patients'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-1 pl-11 space-y-1">
                    <a href="/patients/create" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add New</a>
                    <a href="/patients" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">View All</a>
                    <a href="/patients/appointments" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Appointments</a>
                </div>
            </div>

            <!-- Staff Dropdown -->
            <div x-data="{ isOpen: false }" class="relative">
                <button @click="activeDropdown = activeDropdown === 'staff' ? null : 'staff'"
                        class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Staff
                    <svg :class="{'rotate-180': activeDropdown === 'staff'}" 
                         class="w-4 h-4 ml-auto transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="activeDropdown === 'staff'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                     class="mt-1 pl-11 space-y-1">
                    <a href="/staff/create" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Add New</a>
                    <a href="/staff" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">View All</a>
                    <a href="/staff/schedules" class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Schedules</a>
                </div>
            </div> --}}

            <!-- Settings -->
            <a href="/settings" 
               :class="{'active': currentPath === '/settings'}"
               class="nav-link flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            
                <button type="submit" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium text-red-600 dark:text-red-400 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="lg:pl-64">
        <div class="pt-16 lg:pt-0">
            <!-- Your page content goes here -->
        </div>
    </div>
</div>
    </header>
    </body>

</html>