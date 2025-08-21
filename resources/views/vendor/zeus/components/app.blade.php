<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}" class="antialiased filament js-focus-visible">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta/>
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://events.humanitix.com/scripts/widgets/popup.js" type="module"></script>

    @livewireStyles
    @filamentStyles
    @stack('styles')

    <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}">
    
    @env("production")
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MT88SH9T');</script>
        <!-- End Google Tag Manager -->
    @endenv
    
    
</head>
<body class="font-sans antialiased">
    @env("production")
         <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MT88SH9T" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) --> 
    @endenv
    

    <div class="bg-white  dark:bg-black">
        @include($skyTheme.'.partial.header')
        
        <!-- Twitter-like Layout -->
        <div class="flex mx-auto max-w-7xl">
            <!-- Left Sidebar - Navigation -->
            <div class="fixed flex-col hidden h-full pt-4 lg:flex lg:w-64 xl:w-72">
                <nav class="flex-1 px-4 space-y-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-4 px-4 py-3 text-gray-900 transition-colors rounded-full dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        <span class="text-xl font-medium">Home</span>
                    </a>
                    @auth
                        <a href="{{ route('users.index') }}" class="flex items-center gap-4 px-4 py-3 text-gray-900 transition-colors rounded-full dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xl font-medium">Users</span>
                        </a>
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3 text-gray-900 transition-colors rounded-full dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xl font-medium">Profile</span>
                        </a>
                    @endauth
                </nav>
            </div>

            <!-- Main Content -->
            <main class="flex-1 min-h-screen border-gray-200 lg:ml-64 xl:ml-72 lg:mr-80 xl:mr-96 border-x dark:border-gray-800">
                {{ $slot }}
            </main>

            <!-- Right Sidebar - Trends/Suggestions -->
            <div class="fixed right-0 flex-col hidden h-full pt-4 lg:flex lg:w-80 xl:w-96">
                <div class="px-4 space-y-4">
                    <!-- What's happening -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">What's happening</h2>
                        <div class="space-y-3">
                            <div class="p-2 rounded cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Trending in Technology</p>
                                <p class="font-bold text-gray-900 dark:text-white">{{ config('app.name') }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Social networking platform</p>
                            </div>
                        </div>
                    </div>

                    <!-- Who to follow -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Who to follow</h2>
                        <div class="space-y-3">
                            <!-- This could be populated with actual user suggestions -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 bg-blue-500 rounded-full">
                                        <span class="font-bold text-white">{{ substr(config('app.name'), 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 dark:text-white">{{ config('app.name') }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">@{{ Str::slug(config('app.name')) }}</p>
                                    </div>
                                </div>
                                <button class="px-4 py-1 text-sm font-bold text-white transition-colors bg-black rounded-full dark:bg-white dark:text-black hover:bg-gray-800 dark:hover:bg-gray-200">
                                    Follow
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include($skyTheme.'.partial.footer')
    </div>   
 @include($skyTheme.'.partial.footer-scripts')
</body>
</html>
