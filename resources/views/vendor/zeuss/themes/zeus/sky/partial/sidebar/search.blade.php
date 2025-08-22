<div class="p-6 bg-white border border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700 rounded-2xl">
    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Search Posts</h3>
    <form method="GET" class="space-y-3">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input 
                class="w-full pl-10 pr-4 py-3 text-sm border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400" 
                type="text" 
                name="search" 
                id="search" 
                placeholder="Search articles..." 
                value="{{ request()->get('search') }}">
        </div>
        @if(request()->filled('search'))
            <a href="{{ route('blogs') }}" class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-600 transition-colors bg-gray-100 rounded-full hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Clear search
            </a>
        @endif
    </form>
</div>
