<!-- Twitter-like Top Navigation -->
<header class="sticky top-0 z-50 bg-white/80 dark:bg-black/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-3 hover:bg-gray-100 dark:hover:bg-gray-900 rounded-full p-2 transition-colors">
                    @include($skyTheme.'.partial.logo', ['classes' => 'w-8 h-8'])
                    <span class="hidden sm:block text-xl font-bold text-gray-900 dark:text-white">{{ config('app.name') }}</span>
                </a>
            </div>

            <!-- Search Bar (Hidden on mobile) -->
            <div class="hidden md:flex flex-1 max-w-md mx-8">
                <div class="relative w-full">
                    <input type="text" placeholder="Search users..." class="w-full pl-4 pr-10 py-2 bg-gray-100 dark:bg-gray-900 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 dark:text-white">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- User Actions -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:bg-gray-100 dark:hover:bg-gray-900 rounded-full p-2 transition-colors">
                        <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl(auth()->user()) }}" alt="Profile" class="w-8 h-8 rounded-full">
                        <span class="hidden sm:block text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400">Log in</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-full transition-colors">Sign up</a>
                @endauth
            </div>
        </div>
    </div>
</header>
        </div>
    </header>