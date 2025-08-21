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

            <!-- Main Navigation -->
            <nav class="space-x-8 md:flex">
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

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" class="p-2 text-gray-900 transition-colors rounded-md hover:bg-gray-100 dark:text-white dark:hover:bg-gray-900" 
                        onclick="toggleMobileMenu()" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
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
                    {{-- Admin Link --}}
                    @if(auth()->user()->is_admin)
                        <a href="{{ url('/admin') }}" class="flex items-center gap-2 p-2 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-900" title="Admin Panel">
                            <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-gray-700 dark:text-gray-300" />
                            <span class="hidden text-sm font-medium text-gray-900 sm:block dark:text-white">Admin</span>
                        </a>
                    @endif
                    
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
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden border-t border-gray-200 md:hidden dark:border-gray-800">
            <div class="px-4 py-3 space-y-2">
                @php $menu = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle('main-nav'); @endphp
                @if($menu && $menu->items)
                    @foreach($menu->items as $item)
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