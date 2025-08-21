<!-- Twitter-like Top Navigation -->
<header class="sticky top-0 z-50 border-b border-gray-200 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-3 p-2 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-900">
                    @include($skyTheme.'.partial.logo', ['classes' => 'w-8 h-8'])
                    {{-- <span class="hidden text-xl font-bold text-gray-900 sm:block dark:text-white">{{ config('app.name') }}</span> --}}
                </a>
            </div>

            {{-- <!-- Search Bar (Hidden on mobile) -->
            <div class="flex-1 hidden max-w-md mx-8 md:flex">
                <div class="relative w-full">
                    <input type="text" placeholder="Search users..." class="w-full py-2 pl-4 pr-10 text-gray-900 bg-gray-100 border-0 rounded-full dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div> --}}

            <!-- User Actions -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 p-2 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-900">
                        <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl(auth()->user()) }}" alt="Profile" class="w-8 h-8 rounded-full">
                        <span class="hidden text-sm font-medium text-gray-900 sm:block dark:text-white">{{ auth()->user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-900 hover:text-black dark:text-white dark:hover:text-gray-300">Log in</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white transition-colors bg-black rounded-full hover:bg-gray-800 dark:bg-black dark:hover:bg-gray-900">Sign up</a>
                @endauth
            </div>
        </div>
    </div>
</header>
        </div>
    </header>