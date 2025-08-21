<div>
<!-- Hero Section -->
<section class="relative py-20 overflow-hidden bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="absolute inset-0 bg-grid-gray-900/[0.04] bg-[size:20px_20px] dark:bg-grid-white/[0.02]"></div>
    <div class="relative px-6 mx-auto max-w-7xl lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl">
                Welcome to Our <span class="text-blue-600 dark:text-blue-400">Community</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                Discover the latest insights, connect with fellow entrepreneurs, and stay updated with our upcoming events and initiatives.
            </p>
        </div>
    </div>
</section>

<!-- Featured/Sticky Posts Section -->
@unless($stickies->isEmpty())
<section class="py-16 bg-white dark:bg-gray-800">
    <div class="px-6 mx-auto max-w-7xl lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                Featured Stories
            </h2>
            <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-300">
                Don't miss these highlighted posts from our community
            </p>
        </div>
        <div class="grid gap-8 mx-auto mt-16 @if($stickies->count() > 1) lg:grid-cols-3 @if($stickies->count() > 2) md:grid-cols-2 @endif @endif max-w-2xl lg:mx-0 lg:max-w-none">
            @foreach($stickies as $post)
                @include($skyTheme.'.partial.sticky')
            @endforeach
        </div>
    </div>
</section>
@endunless

<!-- Main Content Area -->
<section class="py-16 bg-gray-50 dark:bg-gray-900">
    <div class="px-6 mx-auto max-w-7xl lg:px-8">
        <div class="flex flex-col gap-12 lg:flex-row lg:gap-16">
            <!-- Posts Section -->
            <main class="flex-1">
                @if(request()->filled('search'))
                    <div class="p-6 mb-8 bg-white border border-blue-200 shadow-sm rounded-2xl dark:bg-gray-800 dark:border-blue-800/30">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <x-heroicon-o-magnifying-glass class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                <span class="text-gray-700 dark:text-gray-200">{{ __('Showing Search result of') }}:</span>
                                <span class="px-3 py-1 text-sm font-medium bg-blue-100 rounded-full text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">{{ request('search') }}</span>
                            </div>
                            <a title="Clear search" href="{{ route('blogs') }}" class="p-2 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-700">
                                @svg('heroicon-o-backspace','w-5 h-5')
                            </a>
                        </div>
                    </div>
                @endif

                @unless ($posts->isEmpty())
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Latest Posts</h2>
                        <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">Stay updated with our latest insights and stories</p>
                    </div>
                    
                    <div class="space-y-8">
                        @each($skyTheme.'.partial.post', $posts, 'post')
                    </div>
                @else
                    @include($skyTheme.'.partial.empty')
                @endunless
            </main>

            <!-- Sidebar -->
            <aside class="w-full lg:w-80">
                <div class="sticky space-y-8 top-8">
                    @include($skyTheme.'.partial.sidebar')
                </div>
            </aside>
        </div>
    </div>
</section>
</div>
