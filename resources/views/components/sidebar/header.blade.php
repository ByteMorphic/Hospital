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