@use('Illuminate\Support\Facades\Storage')

<!-- Event Card -->
<div class="p-6 transition-shadow bg-white border border-gray-200 shadow-sm rounded-2xl dark:bg-gray-800 dark:border-gray-700 hover:shadow-md">
    <div class="flex gap-4">
        <!-- Event Image -->
        <div class="flex-shrink-0">
            @if($event->photo_path)
                <img src="{{ Storage::disk('public')->url($event->photo_path) }}" alt="{{ $event->title }}" class="object-cover w-20 h-20 rounded-2xl">
            @else
                <div class="flex items-center justify-center w-20 h-20 bg-gray-100 rounded-2xl dark:bg-gray-700">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Event Details -->
        <div class="flex-1 min-w-0">
            <!-- Event Header -->
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-gray-900 truncate dark:text-white">
                        {{ $event->title }}
                    </h3>
                    <div class="flex items-center gap-2 mt-1">
                        <!-- Event Type Badge -->
                        @if($event->is_member_event)
                            <span class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                                Member Event
                            </span>
                        @endif

                        <!-- Approval Status -->
                        @if(!$event->is_approved && $event->user_id === auth()->id())
                            <span class="px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900/30 dark:text-yellow-300">
                                Pending Approval
                            </span>
                        @endif

                        <!-- Event Creator -->
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            by {{ $event->user->name }}
                        </span>
                    </div>
                </div>

                <!-- Event Actions -->
                <div class="flex items-center gap-2 ml-4">
                    @can('update', $event)
                        <a href="{{ route('events.edit', $event) }}" class="p-2 text-gray-400 transition-colors rounded-lg hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 dark:hover:text-blue-400" title="Edit Event">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                    @endcan
                    
                    <a href="{{ route('event.show', $event->slug) }}" class="p-2 text-gray-400 transition-colors rounded-lg hover:text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20 dark:hover:text-green-400" title="View Event">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Event Description -->
            
            <div class="overflow-scroll w-52">
                <p class="mb-3 text-sm text-gray-600 line-clamp-2 dark:text-gray-300">
                    {{ Str::limit(strip_tags($event->description), 150) }}
                </p>
            </div>

            <!-- Event Meta Information -->
            <div class="grid grid-cols-1 gap-3 text-sm md:grid-cols-2">
                <!-- Date and Time -->
                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <div class="font-medium text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
                        </div>
                        <div class="text-xs">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('g:i A') }}
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="truncate">{{ $event->address }}</span>
                </div>
            </div>

            <!-- Event Link -->
            @if($event->link)
                <div class="mt-3">
                    <a href="{{ $event->link }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1 text-sm font-medium text-blue-600 transition-colors rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Event Link
                    </a>
                </div>
            @endif

            <!-- Event Tags -->
            @if($event->tags && $event->tags->count() > 0)
                <div class="flex flex-wrap gap-2 mt-3">
                    @foreach($event->tags->take(3) as $tag)
                        <span class="px-2 py-1 text-xs text-gray-600 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                            #{{ $tag->name }}
                        </span>
                    @endforeach
                    @if($event->tags->count() > 3)
                        <span class="px-2 py-1 text-xs text-gray-500 rounded-full bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                            +{{ $event->tags->count() - 3 }} more
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
