@use('Illuminate\Support\Facades\Storage')
@use('Carbon\Carbon')

<x-zeus::app :$skyTheme>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Header Section -->
        <section class="w-full py-8 bg-white shadow-sm dark:bg-gray-800 md:py-16">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-center mb-8 space-y-4 text-center">
                    <h1 class="text-2xl font-bold tracking-tighter text-gray-900 sm:text-3xl md:text-4xl lg:text-5xl dark:text-white">
                        Upcoming Events
                    </h1>
                    <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                        Join us for our upcoming entrepreneur group meetings and member events. Discover
                        the dates, locations, and key highlights of each event.
                    </p>
                </div>
            </div>
        </section>

        <!-- Events Content -->
        <div class="container px-4 mx-auto py-8">
            <!-- Official Entrepreneur Group Meetings -->
            @if($officialEvents && $officialEvents->count() > 0)
                <section class="mb-16">
                    <h2 class="mb-8 text-xl font-bold text-gray-900 md:text-2xl dark:text-white">
                        Upcoming Entrepreneur Group Meetings
                    </h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($officialEvents as $event)
                            <a href="{{ route('public.event.show', $event->slug) }}" class="block transition-transform hover:scale-105">
                                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                                    @if($event->photo_path)
                                        <img src="{{ Storage::disk('public')->url($event->photo_path) }}" alt="{{ $event->title }}" class="object-cover w-full h-48">
                                    @endif
                                    <div class="p-6">
                                        <h3 class="mb-3 text-xl font-semibold text-gray-800 dark:text-white">{{ $event->title }}</h3>
                                        
                                        <!-- Date and Time -->
                                        <div class="flex items-center mb-3 text-sm text-gray-600 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ Carbon::parse($event->start_date)->format('M j, Y \a\t g:i A') }}</span>
                                        </div>
                                        
                                        <!-- Location -->
                                        @if($event->address)
                                            <div class="flex items-center mb-3 text-sm text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                <span>{{ $event->address }}</span>
                                            </div>
                                        @endif
                                        
                                        <!-- Description -->
                                        <p class="text-gray-700 dark:text-gray-200 line-clamp-3">
                                            {!! Str::limit(strip_tags($event->description), 150) !!}
                                        </p>
                                        
                                        <!-- Read More Button -->
                                        <div class="mt-4">
                                            <span class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                Read More
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Member Events -->
            @if($memberEvents && $memberEvents->count() > 0)
                <section class="mb-16">
                    <h2 class="mb-8 text-xl font-bold text-gray-900 md:text-2xl dark:text-white">
                        Upcoming Member Events
                    </h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($memberEvents as $event)
                            <a href="{{ route('public.event.show', $event->slug) }}" class="block transition-transform hover:scale-105">
                                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                                    @if($event->photo_path)
                                        <img src="{{ Storage::disk('public')->url($event->photo_path) }}" alt="{{ $event->title }}" class="object-cover w-full h-48">
                                    @endif
                                    <div class="p-6">
                                        <h3 class="mb-3 text-xl font-semibold text-gray-800 dark:text-white">{{ $event->title }}</h3>
                                        
                                        <!-- Organized by -->
                                        @if($event->user)
                                            <div class="mb-2">
                                                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                                    Organized by {{ $event->user->name }}
                                                </p>
                                            </div>
                                        @endif
                                        
                                        <!-- Date and Time -->
                                        <div class="flex items-center mb-3 text-sm text-gray-600 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ Carbon::parse($event->start_date)->format('M j, Y \a\t g:i A') }}</span>
                                        </div>
                                        
                                        <!-- Location -->
                                        @if($event->address)
                                            <div class="flex items-center mb-3 text-sm text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                <span>{{ $event->address }}</span>
                                            </div>
                                        @endif
                                        
                                        <!-- Description -->
                                        <p class="text-gray-700 dark:text-gray-200 line-clamp-3">
                                            {!! Str::limit(strip_tags($event->description), 150) !!}
                                        </p>
                                        
                                        <!-- Read More Button -->
                                        <div class="mt-4">
                                            <span class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                Read More
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Empty State -->
            @if((!$officialEvents || $officialEvents->count() === 0) && (!$memberEvents || $memberEvents->count() === 0))
                <section class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">No Upcoming Events</h3>
                        <p class="text-gray-600 dark:text-gray-300">Check back soon for new events!</p>
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-zeus::app>
