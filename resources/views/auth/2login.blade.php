@extends('layouts.guest')
@section('title', 'Login')
@section('content')
<div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl">
    <!-- Background image only visible on larger screens -->
    <div class="hidden bg-cover lg:block lg:w-1/2" 
         style="background-image: url('https://images.unsplash.com/photo-1606660265514-358ebbadc80d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1575&q=80');">
    </div>

    <!-- Form container -->
    <div class="w-full px-6 py-8 md:px-8 lg:w-1/2">
        <!-- Logo section -->
        <div class="flex justify-center mx-auto">
            <img class="w-auto h-7 sm:h-8" src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>

        <p class="mt-3 text-xl text-center text-gray-600 dark:text-gray-200">Welcome back!</p>

        <!-- Google Sign-in Button -->
        <a href="#" class="flex items-center justify-center mt-4 text-gray-600 transition-colors duration-300 transform border rounded-lg dark:border-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
            <div class="px-4 py-2">
                <svg class="w-6 h-6" viewBox="0 0 40 40">
                    <!-- SVG for Google Icon -->
                    <path d="..." fill="#FFC107" />
                    <path d="..." fill="#FF3D00" />
                    <path d="..." fill="#4CAF50" />
                    <path d="..." fill="#1976D2" />
                </svg>
            </div>
            <span class="w-5/6 px-4 py-3 font-bold text-center">Sign in with Google</span>
        </a>

        <!-- Divider -->
        <div class="flex items-center justify-between mt-4">
            <span class="w-1/5 border-b dark:border-gray-600 lg:w-1/4"></span>
            <a href="#" class="text-xs text-center text-gray-500 uppercase dark:text-gray-400 hover:underline">or login with email</a>
            <span class="w-1/5 border-b dark:border-gray-400 lg:w-1/4"></span>
        </div>

        <!-- Email Input -->
        <div class="mt-4">
            <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="LoggingEmailAddress">Email Address</label>
            <input id="LoggingEmailAddress" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-hidden focus:ring-3 focus:ring-blue-300" type="email" />
        </div>

        <!-- Password Input with Show/Hide Toggle -->
        <div class="mt-4" x-data="{ show: false }">
            <div class="flex justify-between">
                <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200" for="loggingPassword">Password</label>
                <a href="#" class="text-xs text-gray-500 dark:text-gray-300 hover:underline">Forget Password?</a>
            </div>

            <!-- Password Field with Toggle Button -->
            <div class="relative">
                <input id="loggingPassword" 
                       class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-hidden focus:ring-3 focus:ring-blue-300" 
                       :type="show ? 'text' : 'password'" />
                
                <!-- Toggle Button for Show/Hide Password -->
                <button @click="show = !show" 
                        class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-600 hover:text-gray-800 focus:outline-hidden">
                    <!-- Eye Closed Icon -->
                    <svg :class="{ 'hidden': show, 'block': !show }" class="h-5 w-5" fill="currentColor dark:text-gray-300" viewBox="0 0 24 24">
                        <path d="M12 4.5c-7.06 0-10 5.43-10 7.5s2.94 7.5 10 7.5 10-5.43 10-7.5-2.94-7.5-10-7.5zm0 13c-5.33 0-8-4.11-8-5.5S6.67 6.5 12 6.5 20 10.61 20 12s-2.67 5.5-8 5.5zm0-8.5a3 3 0 100 6 3 3 0 000-6z"/>
                    </svg>
                    <!-- Eye Open Icon -->
                    <svg :class="{ 'block': show, 'hidden': !show }" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M1 12c0-2.07 2.94-7.5 10-7.5S21 9.93 21 12s-2.94 7.5-10 7.5S1 14.07 1 12zm12.99 0a3 3 0 11-6 0 3 3 0 016 0zm1.97 0c0-2.21-1.79-4-4-4s-4 1.79-4 4 1.79 4 4 4 4-1.79 4-4z"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Sign In Button -->
        <div class="mt-6">
            <button class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-hidden focus:ring-3 focus:ring-gray-300 focus:ring-opacity-50">
                Sign In
            </button>
        </div>

        <!-- Sign Up Option -->
        <div class="flex items-center justify-between mt-4">
            <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>
            <a href="#" class="text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline">or sign up</a>
            <span class="w-1/5 border-b dark:border-gray-600 md:w-1/4"></span>
        </div>
    </div>
</div>
@endsection
