
<x-zeus::app :$skyTheme>
<!-- Twitter-like Feed Header -->
<div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Users</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $users->total() }} users</p>
        </div>
        <div class="flex items-center gap-4">
        
            <!-- Search Form -->
            <form method="GET" action="{{ route('users.index') }}" class="flex">
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

<!-- Users Feed -->
<div class="divide-y divide-gray-200 dark:divide-gray-800">
    @forelse ($users as $user)
        <div class="p-4 transition-colors cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-950">
            <div class="flex items-start gap-3">
                @if($user->profile_photo_path)
                    <img src="{{ Storage::disk('public')->url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="object-cover w-12 h-12 rounded-full">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e40af&color=fff" alt="{{ $user->name }}" class="w-12 h-12 rounded-full">
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
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $user->email }}</p>
                    
                    <!-- Social Media Links and Contact -->
                    <div class="flex items-center gap-4 mt-3">
                        @if($user->site_url)
                            <a href="{{ $user->site_url }}" target="_blank" class="text-gray-500 transition-colors hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" title="Website">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.559-.499-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.559.499.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.497-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.148.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        @endif
                        
                        @if($user->twitter_url)
                            <a href="{{ $user->twitter_url }}" target="_blank" class="text-gray-500 transition-colors hover:text-blue-400 dark:text-gray-400 dark:hover:text-blue-300" title="Twitter">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                        @endif
                        
                        @if($user->facebook_url)
                            <a href="{{ $user->facebook_url }}" target="_blank" class="text-gray-500 transition-colors hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400" title="Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        @endif
                        
                        @if($user->linkedin_profile_url)
                            <a href="{{ $user->linkedin_profile_url }}" target="_blank" class="text-gray-500 transition-colors hover:text-blue-700 dark:text-gray-400 dark:hover:text-blue-500" title="LinkedIn">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        @endif
                        
                        @if($user->telephone)
                            <a href="tel:{{ $user->telephone }}" class="text-gray-500 transition-colors hover:text-green-600 dark:text-gray-400 dark:hover:text-green-400" title="Phone: {{ $user->telephone }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </a>
                        @endif
                        
                        <!-- vCard Download -->
                        <a href="{{ route('user.vcard', $user->id) }}" class="text-gray-500 transition-colors hover:text-purple-600 dark:text-gray-400 dark:hover:text-purple-400" title="Download vCard">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                {{-- <div class="flex-shrink-0">
                    <button class="px-4 py-1 text-sm font-bold text-white transition-colors bg-black rounded-full dark:bg-white dark:text-black hover:bg-gray-800 dark:hover:bg-gray-200">
                        Follow
                    </button>
                </div> --}}
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
</x-zeus::app>
