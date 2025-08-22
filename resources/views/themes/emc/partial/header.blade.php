<!-- Twitter-like Top Navigation -->
<header class="sticky top-0 z-50 border-b border-gray-200 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="grid items-center h-16 grid-cols-4 md:grid-cols-3">
            <!-- Logo -->
            <div class="flex items-center justify-start">
                <a href="{{ url('/') }}" class="flex items-center gap-3 p-2 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-900">
                    @include($skyTheme.'.partial.logo', ['classes' => 'w-8 h-8'])
                    {{-- <span class="hidden text-xl font-bold text-gray-900 sm:block dark:text-white">{{ config('app.name') }}</span> --}}
                </a>
            </div>

            <!-- Main Navigation - Hidden on mobile, centered on desktop -->
            <nav class="justify-center hidden gap-6 md:flex md:col-span-1">
                @if($mainNav && $mainNav->items)
                    @foreach($mainNav->items as $item)
                        @if($item['type'] === 'external-link')
                            <a href="{{ $item['url'] }}" 
                               class="text-sm font-medium text-gray-900 transition-colors hover:text-black dark:text-white dark:hover:text-gray-300"
                               @if(str_starts_with($item['url'], 'http'))
                                   target="_blank" rel="noopener noreferrer"
                               @endif>
                                {{ $item['label'] }}
                            </a>
                        @elseif($item['type'] === 'route')
                            @php
                                try {
                                    $routeUrl = route($item['route']);
                                    $isCurrentRoute = request()->routeIs($item['route']);
                                } catch (\Exception $e) {
                                    $routeUrl = '#';
                                    $isCurrentRoute = false;
                                }
                            @endphp
                            <a href="{{ $routeUrl }}" 
                               class="text-sm font-medium text-gray-900 transition-colors hover:text-black dark:text-white dark:hover:text-gray-300 {{ $isCurrentRoute ? 'border-b-2 border-black dark:border-white' : '' }}">
                                {{ $item['label'] }}
                            </a>
                        @endif
                    @endforeach
                @endif
            </nav>

            <!-- Empty spacer for mobile layout -->
            <div class="md:hidden"></div>

            
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
            <div class="flex items-center justify-end col-span-2 gap-2 md:gap-4 md:col-span-1">
                @auth
                    {{-- Admin Link - Hidden on mobile, visible on desktop --}}
                    @if(auth()->user()->is_admin)
                        <a href="{{ url('/admin') }}" class="items-center hidden gap-2 p-2 transition-colors rounded-full md:flex hover:bg-gray-100 dark:hover:bg-gray-900" title="Admin Panel">
                            <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-gray-700 dark:text-gray-300" />
                            <span class="hidden text-sm font-medium text-gray-900 sm:block dark:text-white">Admin</span>
                        </a>
                    @endif
                    
                    {{-- User Profile - Always visible --}}
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 p-2 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-900">
                        @if(auth()->user()->profile_photo_path)
                            <img src="{{ Storage::disk('public')->url(auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" class="object-cover w-8 h-8 rounded-full ring-4 ring-white dark:ring-gray-800">
                        @else
                            <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl(auth()->user()) }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full ring-4 ring-white dark:ring-gray-800">
                        @endif
                        <span class="hidden text-sm font-medium text-gray-900 sm:block dark:text-white">{{ auth()->user()->name }}</span>
                    </a>
                    
                    {{-- Logout Button - Always visible --}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 p-2 text-gray-700 transition-colors rounded-full hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-900" title="Logout">
                            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                        </button>
                    </form>
                @else
                    {{-- Guest Actions - Always visible --}}
                    <a href="{{ route('login') }}" class="px-2 py-1 text-sm font-medium text-gray-900 md:px-4 md:py-2 hover:text-black dark:text-white dark:hover:text-gray-300">Log in</a>
                    <a href="{{ route('register') }}" class="px-2 py-1 text-sm font-medium text-white transition-colors bg-black rounded-full md:px-4 md:py-2 hover:bg-gray-800 dark:bg-black dark:hover:bg-gray-900">Sign up</a>
                @endauth

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button type="button" class="p-2 text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900" 
                            onclick="toggleMobileMenu()" aria-label="Toggle menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden border-t border-gray-200 md:hidden dark:border-gray-800 max-h-[calc(100vh-4rem)] overflow-y-auto">
            <div class="py-3 space-y-2">
                <!-- Main Navigation Items -->
                @if($mainNav && $mainNav->items)
                    @foreach($mainNav->items as $item)
                        @if($item['type'] === 'external-link')
                            <a href="{{ $item['url'] }}" 
                               class="block px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900"
                               @if(str_starts_with($item['url'], 'http'))
                                   target="_blank" rel="noopener noreferrer"
                               @endif>
                                {{ $item['label'] }}
                            </a>
                        @elseif($item['type'] === 'route')
                            @php
                                try {
                                    $routeUrl = route($item['route']);
                                    $isCurrentRoute = request()->routeIs($item['route']);
                                } catch (\Exception $e) {
                                    $routeUrl = '#';
                                    $isCurrentRoute = false;
                                }
                            @endphp
                            <a href="{{ $routeUrl }}" 
                               class="block px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900 {{ $isCurrentRoute ? 'bg-gray-100 dark:bg-gray-900' : '' }}">
                                {{ $item['label'] }}
                            </a>
                        @endif
                    @endforeach
                @endif
                
                @auth
                    <!-- Sub Navigation Section (from left sidebar) -->
                    <div class="pt-3 mt-3 border-t border-gray-200 dark:border-gray-700">
                        <div class="px-3 mb-2 text-xs font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400">
                            Quick Access
                        </div>
                        
                        <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900">
                            <x-heroicon-s-home class="w-5 h-5" />
                            Home
                        </a>
                        
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900">
                            <x-heroicon-s-users class="w-5 h-5" />
                            Members
                        </a>
                        
                        <a href="{{ route('private.events.list', ['user' => auth()->id()]) }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900">
                            <x-heroicon-s-calendar-days class="w-5 h-5" />
                            My Events
                        </a>
                        
                        <a href="{{ route('private.businesses.list', ['user' => auth()->id()]) }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900">
                            <x-tabler-beach class="w-5 h-5" />
                            My Hustles
                        </a>
                        
                        <a href="{{ route('private.library.index', ['user' => auth()->id()]) }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900">
                            <x-heroicon-s-heart class="w-5 h-5" />
                            My Library
                        </a>
                        
                        <a href="{{ route('profile') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900">
                            <x-heroicon-s-user-circle class="w-5 h-5" />
                            Profile
                        </a>
                    </div>
                    
                    @if(auth()->user()->is_admin)
                        <!-- Admin Panel (only in mobile menu) -->
                        <div class="pt-3 mt-3 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ url('/admin') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900">
                                <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
                                Admin Panel
                            </a>
                        </div>
                    @endif
                    
                    @impersonating($guard = null)
                        <!-- Impersonation (only in mobile menu) -->
                        <div class="pt-3 mt-3 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('impersonate.leave') }}" class="flex items-center w-full gap-3 px-3 py-2 text-sm font-medium text-white transition-colors bg-orange-600 rounded-md hover:bg-orange-700 dark:bg-orange-700 dark:hover:bg-orange-800">
                                <x-heroicon-o-finger-print class="w-5 h-5" />
                                Stop Impersonation
                            </a>
                        </div>
                    @endImpersonating
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuButton = event.target.closest('button[onclick="toggleMobileMenu()"]');
    
    if (!menuButton && !mobileMenu.contains(event.target)) {
        mobileMenu.classList.add('hidden');
    }
});
</script>