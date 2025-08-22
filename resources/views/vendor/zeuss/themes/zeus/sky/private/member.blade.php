<x-zeus::private-app :$skyTheme>
<!-- Twitter-like User Profile Header -->
<div class="px-4 py-3 border-b border-gray-200 top-16 bg-white/80 dark:bg-black/80 backdrop-blur-md dark:border-gray-800">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="p-2 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-800">
                <x-heroicon-o-arrow-left class="w-5 h-5 text-gray-700 dark:text-gray-300" />
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Member since {{ $user->created_at->format('M Y') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- User Profile Content -->
<div class="max-w-2xl mx-auto">
    <!-- Profile Header -->
    <div class="px-6 py-8">
        <div class="flex flex-col items-center text-center">
            <!-- Profile Photo -->
            <div class="relative mb-6">
                @if($user->profile_photo_path)
                    <img src="{{ Storage::disk('public')->url($user->profile_photo_path) }}" alt="{{ $user->name }}" class="object-cover w-32 h-32 rounded-full ring-4 ring-white dark:ring-gray-800">
                @else
                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($user) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full ring-4 ring-white dark:ring-gray-800">
                @endif
            </div>

            <!-- User Info -->
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
            
            @if($user->position)
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">{{ $user->position }}</p>
            @endif

            <!-- Location -->
            @if($user->city || $user->country)
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    <x-heroicon-o-map-pin class="inline w-4 h-4 mr-1" />
                    @if($user->city && $user->country)
                        {{ $user->city }}, {{ $user->country }}
                    @elseif($user->city)
                        {{ $user->city }}
                    @else
                        {{ $user->country }}
                    @endif
                </p>
            @endif

            <!-- Bio -->
            @if($user->bio)
                <div class="max-w-md mt-6">
                    <p class="leading-relaxed text-gray-700 dark:text-gray-300">{{ $user->bio }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Contact Information -->
    <div class="px-6 py-6 mx-6 rounded-lg bg-gray-50 dark:bg-gray-900">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Contact Information</h3>
        
        <div class="space-y-3">
            <!-- Email -->
            <div class="flex items-center gap-3">
                <x-heroicon-o-envelope class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                    {{ $user->email }}
                </a>
            </div>

            <!-- Phone -->
            @if($user->telephone)
                <div class="flex items-center gap-3">
                    <x-heroicon-o-phone class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    <a href="tel:{{ $user->telephone }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                        {{ $user->telephone }}
                    </a>
                </div>
            @endif

            <!-- Website -->
            @if($user->site_url)
                <div class="flex items-center gap-3">
                    <x-heroicon-o-globe-alt class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    <a href="{{ $user->site_url }}" target="_blank" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                        {{ parse_url($user->site_url, PHP_URL_HOST) }}
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Social Media Links -->
    @if($user->twitter_url || $user->facebook_url || $user->linkedin_profile_url)
        <div class="px-6 py-6 mx-6 mt-6 rounded-lg bg-gray-50 dark:bg-gray-900">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Social Media</h3>
            
            <div class="flex gap-4">
                @if($user->twitter_url)
                    <a href="{{ $user->twitter_url }}" target="_blank" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                        <x-heroicon-s-hashtag class="w-4 h-4" />
                        Twitter
                    </a>
                @endif

                @if($user->facebook_url)
                    <a href="{{ $user->facebook_url }}" target="_blank" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                        <x-heroicon-o-user-group class="w-4 h-4" />
                        Facebook
                    </a>
                @endif

                @if($user->linkedin_profile_url)
                    <a href="{{ $user->linkedin_profile_url }}" target="_blank" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                        <x-heroicon-o-briefcase class="w-4 h-4" />
                        LinkedIn
                    </a>
                @endif
            </div>
        </div>
    @endif

    <!-- Actions -->
    <div class="px-6 py-6 mx-6 mt-6 rounded-lg bg-gray-50 dark:bg-gray-900">
        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Actions</h3>
        
        <div class="flex gap-3">
            <!-- Download vCard -->
            <a href="{{ route('member.vcard', $user->id) }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
                <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                Download vCard
            </a>

            <!-- Email Contact -->
            <a href="mailto:{{ $user->email }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
                <x-heroicon-o-envelope class="w-4 h-4" />
                Send Email
            </a>

            <!-- Impersonation Button (Admin Only) -->
            @canImpersonate($guard = null) 
                @if(auth()->id() !== $user->id)
                    <a href="{{ route('impersonate', $user->id) }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors bg-orange-600 rounded-lg hover:bg-orange-700 dark:bg-orange-700 dark:hover:bg-orange-800" onclick="return confirm('Are you sure you want to impersonate this user?')">
                        <x-heroicon-o-finger-print class="w-4 h-4" />
                        Impersonate this user
                    </a>
                @endif
            @endCanImpersonate
        </div>
    </div>

    <!-- Member Since -->
    <div class="px-6 py-4 text-center">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Member since {{ $user->created_at->format('F j, Y') }}
        </p>
    </div>
</div>
</x-zeus::app>
