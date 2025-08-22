<x-zeus::private-app :$skyTheme>
<!-- Twitter-like Feed Header -->
<div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">My Businesses</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $businesses->total() }} businesses</p>
        </div>
        <div class="flex items-center gap-4">
            <!-- Create Business Button -->
            <a href="{{ route('private.businesses.create', auth()->user()) }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-800 rounded-full hover:bg-blue-900 dark:bg-blue-700 dark:hover:bg-blue-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add an hustle
            </a>
            
            <!-- Search Form -->
            <form method="GET" action="{{ route('private.businesses.list', ['user' => auth()->id()]) }}" class="flex">
                <div class="relative">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search businesses..." class="w-64 py-2 pl-4 pr-4 text-sm text-gray-900 bg-gray-100 border-0 rounded-full dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-800 dark:text-white">
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

@if(session('success'))
    <div class="p-4 mx-4 mt-4 text-green-700 bg-green-100 border border-green-400 rounded-2xl dark:bg-green-900 dark:border-green-600 dark:text-green-300">
        {{ session('success') }}
    </div>
@endif

<!-- Search Results Info -->
@if(isset($search) && $search)
    <div class="flex items-center gap-3 p-4 mx-4 mt-4 border border-blue-200 bg-blue-50 rounded-2xl dark:bg-blue-900/20 dark:border-blue-800">
        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span class="text-blue-900 dark:text-blue-300">Showing search results for:</span>
        <span class="px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/50 dark:text-blue-300">{{ $search }}</span>
        <a href="{{ route('private.businesses.list', ['user' => auth()->id()]) }}" class="ml-auto text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Clear search</a>
    </div>
@endif

<!-- Business Feed -->
<div class="divide-y divide-gray-200 dark:divide-gray-800">
    @forelse ($businesses as $business)
        <div class="p-4 transition-colors cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-950">
            <div class="flex items-start gap-3">
                <!-- Business Logo -->
                @if($business->photo_path)
                    <img src="{{ asset('storage/' . $business->photo_path) }}" alt="{{ $business->name }}" class="object-cover w-12 h-12 rounded-full">
                @else
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full dark:bg-gray-800">
                        <span class="text-sm font-bold text-gray-400 dark:text-gray-500">
                            {{ substr($business->name, 0, 2) }}
                        </span>
                    </div>
                @endif
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <h3 class="font-bold text-gray-900 truncate dark:text-white">{{ $business->name }}</h3>
                        @if($business->is_sponsor)
                            <span class="px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900/30 dark:text-yellow-300">
                                ⭐ Sponsor
                            </span>
                        @endif
                        @if(!$business->is_public)
                            <span class="px-2 py-1 text-xs font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-900/30 dark:text-gray-300">
                                Private
                            </span>
                        @endif
                        @if(!$business->is_approved)
                            <span class="px-2 py-1 text-xs font-medium text-orange-800 bg-orange-100 rounded-full dark:bg-orange-900/30 dark:text-orange-300">
                                Pending Approval
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-sm text-gray-500 dark:text-gray-400">·</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $business->created_at->diffForHumans() }}</span>
                    </div>
                    
                    <!-- Business Description -->
                    <div class="mt-2">
                        <p class="text-sm text-gray-900 dark:text-white">{!! Str::limit(strip_tags($business->description), 200) !!}</p>
                    </div>
                    
                    <!-- Business Details -->
                    <div class="mt-3 space-y-2">
                        <!-- Contact Info -->
                        @if($business->email)
                            <div class="flex text-blue-500 transition-colors hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300">
                                <x-heroicon-o-envelope class="w-5 h-5 mr-2" />
                                <span>{{ $business->email }}</span>
                            </div>
                        @endif
                        
                        <!-- Website -->
                        @if($business->url)
                            <div class="flex text-blue-500 transition-colors hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300">
                                <x-heroicon-o-globe-europe-africa class="w-5 h-5 mr-2" />
                                <span>{{ parse_url($business->url, PHP_URL_HOST) }}</span>
                            </div>
                        @endif

                        @if($business->telephone)
                            <a href="tel:{{ $business->telephone }}" 
                                class="flex text-blue-500 transition-colors hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300">
                                <x-heroicon-s-phone class="w-6 h-6" />
                            </a>
                        @endif

                        @if($business->linkedin_url)
                            <a href="{{ $business->linkedin_url }}" target="_blank" 
                                class="flex text-blue-500 transition-colors hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300">
                                <x-fab-linkedin class="w-6 h-6" />
                            </a>
                        @endif
                    </div>
                    
                    <!-- Action Links -->
                    <div class="flex items-center gap-4 mt-3">
                        <a href="{{ route('public.business.show', $business->slug) }}" target="_blank" class="text-blue-500 transition-colors hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300" title="View Public Page">
                            <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5" />
                        </a>
                        
                        <a href="{{ route('private.businesses.edit', ['user' => $business->user_id, 'business' => $business->id]) }}" class="text-blue-500 transition-colors hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300" title="Edit Business">
                            <x-heroicon-o-pencil class="w-5 h-5" />
                            </svg>
                        </a>
                        
                        <form action="{{ route('private.businesses.destroy', ['user' => $business->user_id, 'business' => $business->id]) }}" method="POST" class="inline" 
                              onsubmit="return confirm('Are you sure you want to delete this business? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 transition-colors hover:text-red-600 dark:text-red-400 dark:hover:text-red-300" title="Delete Business">
                                <x-heroicon-o-trash class="w-5 h-5" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="py-16 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No businesses found</h3>
            <p class="text-gray-500 dark:text-gray-400">{{ isset($search) && $search ? 'Try adjusting your search to find what you\'re looking for.' : 'Be the first to create a business!' }}</p>
            @unless(isset($search) && $search)
                <a href="{{ route('private.businesses.create', auth()->user()) }}" class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add an hustle
                </a>
            @endunless
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($businesses->hasPages())
    <div class="flex items-center justify-between p-4 border-t border-gray-200 dark:border-gray-800">
        <div class="flex items-center">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Showing {{ $businesses->firstItem() }} to {{ $businesses->lastItem() }} of {{ $businesses->total() }} results
            </p>
        </div>
        <div class="flex items-center space-x-2">
            @if ($businesses->onFirstPage())
                <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
                    Previous
                </span>
            @else
                <a href="{{ $businesses->appends(request()->query())->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Previous
                </a>
            @endif

            <span class="px-3 py-2 text-sm text-white bg-blue-800 rounded-lg dark:bg-blue-800 dark:text-white">
                {{ $businesses->currentPage() }} of {{ $businesses->lastPage() }}
            </span>

            @if ($businesses->hasMorePages())
                <a href="{{ $businesses->appends(request()->query())->nextPageUrl() }}" 
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
</x-zeus::private-app>
