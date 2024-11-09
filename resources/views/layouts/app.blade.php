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
        isSidebarMinimized: localStorage.getItem('sidebarMinimized') === 'true',


        
        toggleSidebar() {
            this.isSidebarMinimized = !this.isSidebarMinimized;
            localStorage.setItem('sidebarMinimized', this.isSidebarMinimized);
        }
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