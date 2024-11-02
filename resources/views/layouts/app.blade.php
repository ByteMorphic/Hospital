<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('styles')
    <style>
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
    
        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }
    
        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }
    
        @keyframes bounce {
            to {
                transform: translateY(-20px);
            }
        }
    </style>

    
    

    
    
</head>
<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">

    <!-- Preloader HTML -->
    
    <div id="preloader">
        <div class="loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <header>
        <x-nav />
    </header>

    <!-- Notification component -->
    <x-notification />

    <main class="container flex-grow px-4 mx-auto" id="main-content" style="display: none;">
        @yield('content')
    </main>

    <x-footer />

    @stack('scripts')

    <!-- jQuery and Select2 scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- JavaScript to hide the preloader -->
    <script>
        window.addEventListener('load', function() {
            document.getElementById('preloader').style.display = 'none';
            document.getElementById('main-content').style.display = 'block';
        });

        // Dark mode check
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.body.classList.add('dark');
        }
    </script>
</body>
</html>
