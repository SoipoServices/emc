@use('Illuminate\Support\Facades\Storage')
@use('Carbon\Carbon')

<x-zeus::app :$skyTheme>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Event Header -->
        <section class="w-full py-8 bg-white shadow-sm dark:bg-gray-800 md:py-16">
            <div class="container px-4 mx-auto">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('public.events.index') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to Events
                    </a>
                </div>

                <div class="max-w-4xl mx-auto">
                    <!-- Event Type Badge -->
                    <div class="mb-4">
                        @if($event->is_member_event)
                            <span class="px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                Member Event
                            </span>
                        @else
                            <span class="px-3 py-1 text-sm font-medium text-red-800 bg-red-100 rounded-full dark:bg-red-900/30 dark:text-red-300">
                                Official Event
                            </span>
                        @endif
                    </div>

                    <!-- Event Title -->
                    <h1 class="mb-6 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl md:text-5xl dark:text-white">
                        {{ $event->title }}
                    </h1>

                    <!-- Organized by (for member events) -->
                    @if($event->is_member_event && $event->user)
                        <div class="mb-6">
                            <p class="text-lg font-medium text-blue-600 dark:text-blue-400">
                                Organized by {{ $event->user->name }}
                            </p>
                        </div>
                    @endif

                    <!-- Event Details -->
                    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
                        <!-- Date and Time -->
                        <div class="flex items-center p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                            <svg class="w-6 h-6 mr-3 {{ $event->is_member_event ? 'text-blue-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">Date & Time</h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    {{ Carbon::parse($event->start_date)->format('l, F j, Y') }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-300">
                                    {{ Carbon::parse($event->start_date)->format('g:i A') }}
                                    @if($event->start_date !== $event->end_date)
                                        - {{ Carbon::parse($event->end_date)->format('g:i A') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Location -->
                        @if($event->address)
                            <div class="flex items-center p-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                                <svg class="w-6 h-6 mr-3 {{ $event->is_member_event ? 'text-blue-500' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Location</h3>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $event->address }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Event Link -->
                    @if($event->link)
                        <div class="mb-8">
                            <a href="{{ $event->link }}" target="_blank" class="inline-flex items-center px-6 py-3 font-medium text-white {{ $event->is_member_event ? 'bg-blue-600 hover:bg-blue-700' : 'bg-red-600 hover:bg-red-700' }} rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Event Registration / More Info
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Event Content -->
        <section class="w-full py-12">
            <div class="container px-4 mx-auto">
                <div class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
                        <!-- Main Content -->
                        <div class="lg:col-span-2">
                            <!-- Event Image -->
                            @if($event->photo_path)
                                <div class="mb-8">
                                    <img src="{{ Storage::disk('public')->url($event->photo_path) }}" alt="{{ $event->title }}" class="object-cover w-full h-64 rounded-lg shadow-lg md:h-80">
                                </div>
                            @endif

                            <!-- Event Description -->
                            <div class="prose prose-lg max-w-none dark:prose-invert">
                                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">About This Event</h2>
                                <div class="text-gray-700 dark:text-gray-200">
                                    {!! $event->description !!}
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1">
                            <div class="sticky top-8">
                                <!-- Quick Info Card -->
                                <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Quick Info</h3>
                                    
                                    <!-- Event Type -->
                                    <div class="mb-4">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Event Type</p>
                                        <p class="text-gray-900 dark:text-white">
                                            @if($event->is_member_event)
                                                Member Event
                                            @else
                                                Official EMC Event
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Organizer -->
                                    @if($event->user)
                                        <div class="mb-4">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Organizer</p>
                                            <p class="text-gray-900 dark:text-white">{{ $event->user->name }}</p>
                                        </div>
                                    @endif

                                    <!-- Duration -->
                                    <div class="mb-4">
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration</p>
                                        <p class="text-gray-900 dark:text-white">
                                            @php
                                                $startDate = $event->start_date;
                                                $endDate = $event->end_date;
                                               
                                                $daysDiff = $startDate->diffInDays($endDate);
                                            @endphp
                                            @if($daysDiff > 1)
                                                {{ $daysDiff + 1 }} Days
                                            @else
                                                @php
                                                    $hoursDiff = $startDate->diffInHours($endDate);
                                                @endphp
                                                @if($hoursDiff <= 1)
                                                    {{ $startDate->diffInMinutes($endDate) }} Minutes
                                                @else
                                                    {{ $hoursDiff }} Hours
                                                @endif
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Share Event -->
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <p class="mb-3 text-sm font-medium text-gray-500 dark:text-gray-400">Share Event</p>
                                        <div class="flex space-x-3">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="p-2 text-gray-600 transition-colors hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                </svg>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->title . ' - ' . request()->url()) }}" target="_blank" class="p-2 text-gray-600 transition-colors hover:text-blue-400 dark:text-gray-400 dark:hover:text-blue-300">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                                </svg>
                                            </a>
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="p-2 text-gray-600 transition-colors hover:text-blue-700 dark:text-gray-400 dark:hover:text-blue-500">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Join EMC Call-to-Action -->
                                <div class="p-6 mt-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Join Our Community</h3>
                                    <p class="mb-4 text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                                        Connect with entrepreneurs in Cagliari and never miss an event.
                                    </p>
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-2 text-sm font-semibold text-white transition-all duration-200 transform bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 hover:scale-105">
                                        Join EMC
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-zeus::app>
