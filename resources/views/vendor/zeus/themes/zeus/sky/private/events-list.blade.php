<x-zeus::private-app :$skyTheme>
<!-- Twitter-like Feed Header -->
<div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Events</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $allEvents->total() }} events</p>
        </div>
        <div class="flex items-center gap-4">
            <!-- Create Event Button -->
            <a href="{{ route('private.events.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-800 rounded-full hover:bg-blue-900 dark:bg-blue-700 dark:hover:bg-blue-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create Event
            </a>
            
            <!-- Search Form -->
            <form method="GET" action="{{ route('private.events.list') }}" class="flex">
                <div class="relative">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search events..." class="w-64 py-2 pl-4 pr-4 text-sm text-gray-900 bg-gray-100 border-0 rounded-full dark:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-800 dark:text-white">
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
@if($search)
    <div class="flex items-center gap-3 p-4 mx-4 mt-4 bg-blue-50 border border-blue-200 rounded-2xl dark:bg-blue-900/20 dark:border-blue-800">
        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <span class="text-blue-900 dark:text-blue-300">Showing search results for:</span>
        <span class="px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/50 dark:text-blue-300">{{ $search }}</span>
        <a href="{{ route('private.events.list') }}" class="ml-auto text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Clear search</a>
    </div>
@endif

<!-- Events Feed -->
<div class="divide-y divide-gray-200 dark:divide-gray-800">
    @forelse ($allEvents as $event)
        @include('vendor.zeus.themes.zeus.sky.private.partials.event-feed-item', ['event' => $event])
    @empty
        <div class="py-16 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">No events found</h3>
            <p class="text-gray-500 dark:text-gray-400">{{ $search ? 'Try adjusting your search to find what you\'re looking for.' : 'Be the first to create an event!' }}</p>
            @unless($search)
                <a href="{{ route('private.events.create') }}" class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Event
                </a>
            @endunless
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($allEvents->hasPages())
    <div class="flex items-center justify-between p-4 border-t border-gray-200 dark:border-gray-800">
        <div class="flex items-center">
            <p class="text-sm text-gray-700 dark:text-gray-300">
                Showing {{ $allEvents->firstItem() }} to {{ $allEvents->lastItem() }} of {{ $allEvents->total() }} results
            </p>
        </div>
        <div class="flex items-center space-x-2">
            @if ($allEvents->onFirstPage())
                <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
                    Previous
                </span>
            @else
                <a href="{{ $allEvents->appends(request()->query())->previousPageUrl() }}" 
                   class="px-3 py-2 text-sm text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    Previous
                </a>
            @endif

            <span class="px-3 py-2 text-sm text-white bg-blue-800 rounded-lg dark:bg-blue-800 dark:text-white">
                {{ $allEvents->currentPage() }} of {{ $allEvents->lastPage() }}
            </span>

            @if ($allEvents->hasMorePages())
                <a href="{{ $allEvents->appends(request()->query())->nextPageUrl() }}" 
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
