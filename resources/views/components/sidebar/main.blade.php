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