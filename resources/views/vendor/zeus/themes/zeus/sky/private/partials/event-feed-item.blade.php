@use('Illuminate\Support\Facades\Storage')
@use('Carbon\Carbon')

<div class="p-4 transition-colors cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-950">
    <div class="flex items-start gap-3">
        <!-- User Photo or App Logo -->
        @if($event->is_member_event && $event->user)
            @if($event->user->profile_photo_path)
                <img src="{{ Storage::disk('public')->url($event->user->profile_photo_path) }}" alt="{{ $event->user->name }}" class="object-cover w-12 h-12 rounded-full">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($event->user->name) }}&background=1e40af&color=fff" alt="{{ $event->user->name }}" class="w-12 h-12 rounded-full">
            @endif
        @else
            <!-- App Logo for non-member events -->
            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full dark:bg-green-900/30">
                <div class="flex items-center justify-center w-8 h-8 bg-green-600 rounded-full dark:bg-green-500">
                    <span class="text-xs font-bold text-white">{{ substr(config('app.name'), 0, 2) }}</span>
                </div>
            </div>
        @endif
        
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-900 truncate dark:text-white">{{ Str::limit(strip_tags($event->title), 100) }}</h3>
                
            </div>
            <div class="flex items-center gap-2">
                @if(!$event->is_approved)
                    <span class="px-2 py-1 text-xs font-medium text-orange-800 bg-orange-100 rounded-full dark:bg-orange-900/30 dark:text-orange-300">
                        Pending Approval
                    </span>
                @endif
                @if($event->is_member_event)
                    <span class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-300">
                        Member Event
                    </span>
                @endif
                <span class="text-sm text-gray-500 dark:text-gray-400">·</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $event->created_at->diffForHumans() }}</span>
            </div>
            @if($event->user)
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                    <span class="text-gray-500 dark:text-gray-400">Created by</span> {{ $event->user->name }}
                </p>
            @endif
            
            <!-- Event Description (HTML content stripped and limited) -->
            <div class="overflow-scroll">
                <p class="mt-2 text-sm text-gray-900 dark:text-white">{!! $event->description !!}</p>
            </div>
            
            <!-- Event Details with Color-coded Icons -->
            <div class="mt-3 space-y-2">
                <!-- Date and Time -->
                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <svg class="w-4 h-4 mr-2 {{ $event->is_member_event ? 'text-blue-500' : 'text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ Carbon::parse($event->start_date)->format('M j, Y') }}</span>
                    @if($event->start_date !== $event->end_date)
                        <span class="mx-1">-</span>
                        <span>{{ Carbon::parse($event->end_date)->format('M j, Y') }}</span>
                    @endif
                    <span class="ml-2 text-gray-500">
                        {{ Carbon::parse($event->start_date)->format('g:i A') }}
                    </span>
                </div>
                
                <!-- Location -->
                @if($event->address)
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2 {{ $event->is_member_event ? 'text-blue-500' : 'text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $event->address }}</span>
                    </div>
                @endif
            </div>
            
            <!-- Action Links with Color-coded Icons -->
            <div class="flex items-center gap-4 mt-3">
                @if($event->link)
                    <a href="{{ $event->link }}" target="_blank" class="transition-colors {{ $event->is_member_event ? 'text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300' : 'text-green-500 hover:text-green-600 dark:text-green-400 dark:hover:text-green-300' }}" title="Event Link">
                        <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5" />
                    </a>
                @endif
                
                @if(Route::has('event.show'))
                    <a href="{{ route('event.show', $event->slug) }}" class="transition-colors {{ $event->is_member_event ? 'text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300' : 'text-green-500 hover:text-green-600 dark:text-green-400 dark:hover:text-green-300' }}" title="View Details">
                        <x-heroicon-o-eye class="w-5 h-5" />
                    </a>
                @endif
                
                @can('update', $event)
                    <a href="#" class="text-gray-500 transition-colors hover:text-yellow-600 dark:text-gray-400 dark:hover:text-yellow-400" title="Edit Event">
                        <x-heroicon-o-pencil class="w-5 h-5" />
                    </a>
                @endcan
                
                @can('delete', $event)
                    <a href="#" class="text-gray-500 transition-colors hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400" title="Delete Event">
                        <x-heroicon-o-trash class="w-5 h-5" />
                    </a>
                @endcan
            </div>
        </div>
        
        <!-- Event Image (if available) -->
        @if($event->photo_path)
            <div class="flex-shrink-0">
                <img src="{{ Storage::disk('public')->url($event->photo_path) }}" alt="{{ $event->title }}" class="object-cover w-20 h-20 rounded-lg">
            </div>
        @endif
    </div>
</div>
