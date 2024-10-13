<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') - {{ env('APP_NAME') }}</title>
        @vite('resources/css/app.css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        @stack('styles')
    </head>
    <body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        <header>
            <x-drugdept.nav />
        </header>

        <!-- Notification component -->
        <x-drugdept.notification />

        <main class="container flex-grow px-4 mx-auto">
            @yield('content')
        </main>

        @vite('resources/js/app.js')
        <x-footer />
        @stack('scripts')
        <!-- Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </body>
</html>
