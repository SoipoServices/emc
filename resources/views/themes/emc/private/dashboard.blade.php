
@use('Illuminate\Support\Facades\Storage')
@use('Illuminate\Support\Str')

<x-theme::private-app>
<!-- Twitter-like Feed Header -->
<div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Members</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $users->total() }} members</p>
        </div>
        <div class="flex items-center gap-4">
        
            <!-- Search Form -->
            <form method="GET" action="{{ route('dashboard') }}" class="flex">
                <div class="relative">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search users..." class="w-64 py-2 pl-4 pr-4 text-sm text-gray-900 bg-gray-100 border-0 rounded-full dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-800 dark:text-white">
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-2">
                        <svg class="w-5 h-5 text-gray-400 hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Search Results Info -->
@if($search)
    <div class="flex items-center gap-3 p-4 mx-4 mt-4 border border-blue-200 bg-blue-50 rounded-2xl dark:bg-blue-900/20 dark:border-blue-800">
        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span class="text-blue-900 dark:text-blue-300">Showing search results for:</span>
        <span class="px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/50 dark:text-blue-300">{{ $search }}</span>
        <a href="{{ route('dashboard') }}" class="ml-auto text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Clear search</a>
    </div>
@endif

{{-- <!-- Quick Actions Card -->
<div class="p-4 mx-4 mt-4 border border-blue-200 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl dark:from-blue-900/20 dark:to-indigo-900/20 dark:border-blue-800">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="font-semibold text-blue-900 dark:text-blue-300">Share an Event</h3>
            <p class="text-sm text-blue-700 dark:text-blue-400">Create and share upcoming events with the community</p>
        </div>
        <a href="{{ route('private.events.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-800 rounded-full hover:bg-blue-900 dark:bg-blue-700 dark:hover:bg-blue-800">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Create Event
        </a>
    </div>
</div> --}}

<!-- Users Feed -->
<div class="divide-y divide-gray-200 dark:divide-gray-800">
    @forelse ($users as $user)
        <div class="p-4 transition-colors cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-950">
            <div class="flex items-start gap-3">
                @if($user->profile_photo_path)
                    <img src="{{ Storage::disk('public')->url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="object-cover w-12 h-12 rounded-full">
                @else
                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($user) }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full">
                @endif
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <h3 class="font-bold text-gray-900 truncate dark:text-white">{{ $user->name }}</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">·</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                    @if($user->position)
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $user->position }}</p>
                    @endif
                    
                    {{-- Location Information --}}
                    @if($user->city || $user->country)
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            @if($user->city && $user->country)
                                {{ $user->city }}, {{ $user->country }}
                            @elseif($user->city)
                                {{ $user->city }}
                            @else
                                {{ $user->country }}
                            @endif
                        </p>
                    @endif
                    
                    <!-- Social Media Links and Contact -->
                    <div class="flex items-center gap-4 mt-3">
                        <!-- Email -->
                        <a href="mailto:{{ $user->email }}" class="text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300" title="Email: {{ $user->email }}">
                            <x-heroicon-o-envelope class="w-5 h-5" />
                        </a>
                        
                        @if($user->site_url)
                            <a href="{{ $user->site_url }}" target="_blank" class="text-gray-500 transition-colors hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" title="Website">
                                <x-heroicon-o-globe-alt class="w-5 h-5" />
                            </a>
                        @endif
                        
                        @if($user->twitter_url)
                            <a href="{{ $user->twitter_url }}" target="_blank" class="text-gray-500 transition-colors hover:text-blue-400 dark:text-gray-400 dark:hover:text-blue-300" title="Twitter">
                                <x-heroicon-s-hashtag class="w-5 h-5" />
                            </a>
                        @endif
                        
                        @if($user->facebook_url)
                            <a href="{{ $user->facebook_url }}" target="_blank" class="text-gray-500 transition-colors hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" title="Facebook">
                                <x-heroicon-o-user-group class="w-5 h-5" />
                            </a>
                        @endif
                        
                        @if($user->linkedin_profile_url)
                            <a href="{{ $user->linkedin_profile_url }}" target="_blank" class="text-gray-500 transition-colors hover:text-blue-700 dark:text-gray-400 dark:hover:text-blue-500" title="LinkedIn">
                                <x-heroicon-o-briefcase class="w-5 h-5" />
                            </a>
                        @endif
                        
                        @if($user->telephone)
                            <a href="tel:{{ $user->telephone }}" class="text-gray-500 transition-colors hover:text-green-600 dark:text-gray-400 dark:hover:text-green-400" title="Phone: {{ $user->telephone }}">
                                <x-heroicon-o-phone class="w-5 h-5" />
                            </a>
                        @endif
                        
                        <!-- vCard Download -->
                        <a href="{{ route('member.vcard', $user->id) }}" class="text-gray-500 transition-colors hover:text-purple-600 dark:text-gray-400 dark:hover:text-purple-400" title="Download vCard">
                            <x-heroicon-o-arrow-down-tray class="w-5 h-5" />
                        </a>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('member', $user) }}" class="flex items-center justify-center w-10 h-10 text-gray-500 transition-colors rounded-full hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300" title="View Profile">
                        <x-heroicon-o-eye class="w-5 h-5" />
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="py-16 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No users found</h3>
            <p class="text-gray-500 dark:text-gray-400">Try adjusting your search to find what you're looking for.</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($users->hasPages())
    <div class="flex items-center justify-between p-4 border-t border-gray-200 dark:border-gray-800">
        <div class="flex items-center">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
            </p>
        </div>
        <div class="flex items-center space-x-2">
            @if ($users->onFirstPage())
                <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
                    Previous
                </span>
            @else
                <a href="{{ $users->appends(request()->query())->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Previous
                </a>
            @endif

            <span class="px-3 py-2 text-sm text-white bg-blue-800 rounded-lg dark:bg-blue-800 dark:text-white">
                {{ $users->currentPage() }} of {{ $users->lastPage() }}
            </span>

            @if ($users->hasMorePages())
                <a href="{{ $users->appends(request()->query())->nextPageUrl() }}" 
                   class="px-3 py-2 text-sm text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Next
                </a>
            @else
                <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
                    Next
                </span>
            @endif
        </div>
    </div>
@endif
</x-theme::private-app>
