@use('Illuminate\Support\Facades\Storage')
@use('Illuminate\Support\Str')

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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
    

    <div class="bg-white dark:bg-black">
        @include($skyTheme.'.partial.header')
        
        <!-- Layout -->
        <div class="flex mx-auto max-w-7xl">
            <!-- Left Sidebar - Navigation -->
            <div class="flex-col hidden h-full pt-4 lg:flex lg:w-54 xl:w-64">
                <nav class="flex-1 px-4 space-y-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-4 px-4 py-3 text-gray-900 transition-colors rounded-full dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900">
                        <x-heroicon-s-home class="w-6 h-6" />
                        <span class="text-xl font-medium">Home</span>
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3 text-gray-900 transition-colors rounded-full dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900">
                            <x-heroicon-s-users class="w-6 h-6" />
                            <span class="text-xl font-medium">Members</span>
                        </a>
                        <a href="{{ route('private.events.list') }}" class="flex items-center gap-4 px-4 py-3 text-gray-900 transition-colors rounded-full dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900">
                            <x-heroicon-s-calendar-days class="w-6 h-6" />
                            <span class="text-xl font-medium">Events</span>
                        </a>
                        <a href="{{ route('profile') }}" class="flex items-center gap-4 px-4 py-3 text-gray-900 transition-colors rounded-full dark:text-white hover:bg-gray-100 dark:hover:bg-gray-900">
                            <x-heroicon-s-user-circle class="w-6 h-6" />
                            <span class="text-xl font-medium">Profile</span>
                        </a>
                    @endauth
                </nav>
            </div>

            <!-- Main Content -->
            <main class="flex-1 min-h-screen border-gray-200 border-x dark:border-gray-800">
                {{ $slot }}
            </main>

            <!-- Right Sidebar - Trends/Suggestions -->
            <div class="flex-col hidden h-full pt-4 lg:flex lg:w-64 xl:w-72">
                <div class="px-4 space-y-4">
                    <!-- What's happening -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl hover:shadow-md group-hover:scale-[1.02]">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">What's happening</h2>
                        <div class="space-y-3">
                            <div class="p-2 rounded cursor-pointer ">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Trending in Technology</p>
                                <p class="font-bold text-gray-900 dark:text-white">{{ config('app.name') }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Social networking platform</p>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Event -->
                    @if(isset($latestEvent) && $latestEvent)
                    <div class="p-4 border hover:shadow-md group-hover:scale-[1.02] border-blue-100 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl dark:border-blue-800/30">
                        <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900 dark:text-white">
                            <x-heroicon-o-calendar-days class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" />
                            Upcoming Event
                        </h2>
                        
                        <a href="{{ route('event.show', $latestEvent->slug) }}" class="block group">
                            <div class="transition-all bg-white dark:bg-gray-800 ">
                                @if($latestEvent->photo_path)
                                    <div class="mb-3">
                                        <img src="{{ Storage::disk('public')->url($latestEvent->photo_path) }}" 
                                             alt="{{ $latestEvent->title }}" 
                                             class="object-cover w-full h-40 rounded-t-lg">
                                    </div>
                                @endif
                                
                                <div class="p-4">
                                    <h3 class="mb-2 text-lg font-bold text-gray-900 transition-colors dark:text-white group-hover:text-black dark:group-hover:text-gray-200">{{ $latestEvent->title }}</h3>
                                    <div class="mb-3 text-sm text-gray-600 dark:text-gray-300 line-clamp-3">
                                        {!! Str::limit(strip_tags($latestEvent->description), 150) !!}
                                    </div>
                                    
                                    <div class="space-y-2 text-sm text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center">
                                            <x-heroicon-o-calendar class="w-4 h-4 mr-2 text-gray-600 dark:text-gray-400" />
                                            {{ $latestEvent->start_date->format('M j, Y') }}
                                        </div>
                                        <div class="flex items-center">
                                            <x-heroicon-o-clock class="w-4 h-4 mr-2 text-gray-600 dark:text-gray-400" />
                                            {{ $latestEvent->start_date->format('g:i A') }}
                                        </div>
                                        @if($latestEvent->address)
                                            <div class="flex items-center">
                                                <x-heroicon-o-map-pin class="w-4 h-4 mr-2 text-gray-600 dark:text-gray-400" />
                                                {{ Str::limit($latestEvent->address, 40) }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center mt-3 text-sm font-medium text-gray-900 dark:text-white group-hover:text-black dark:group-hover:text-gray-200">
                                        View Event Details
                                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" />
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @else 
                    @endif

                    <!-- Quick Actions Card -->
                    <div href="{{ route('private.events.create') }}" class="p-4 border hover:shadow-md group-hover:scale-[1.02] border-blue-100 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl dark:border-blue-800/30">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('private.events.create') }}">
                                <h3 class="font-semibold text-blue-900 dark:text-blue-300">Share an Event</h3>
                                <p class="text-sm text-blue-700 dark:text-blue-400">Create and share upcoming events with the community</p>
                            </a>
                           
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
