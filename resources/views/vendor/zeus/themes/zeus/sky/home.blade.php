<div>
    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden bg-gradient-to-r from-gray-900 via-black to-gray-900">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">
                    Elevate Your Entrepreneurial Journey
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-300">
                    Join our entrepreneur group meetings and unlock invaluable insights, networking opportunities, and personalized guidance to propel your business forward.
                </p>
                <div class="flex items-center justify-center mt-10 gap-x-6">
                    <a href="{{ route('register') }}" class="rounded-md bg-black px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                        Join Now
                    </a>
                    <a href="{{ route('events.index') }}" class="text-sm font-semibold leading-6 text-white">
                        View Events <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Background Image -->
        <div class="absolute inset-0 -z-10">
            <img src="{{ asset('resources/images/event_pic.jpg') }}" alt="Entrepreneur meetup" class="object-cover w-full h-full opacity-30">
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-white dark:bg-gray-800">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    Unlock Your Entrepreneurial Potential
                </h2>
                <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Our entrepreneur group meetings offer a transformative experience, empowering you with the connections, and guidance to elevate your business to new heights.
                </p>
            </div>
            <div class="max-w-2xl mx-auto mt-16 sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col items-center text-center">
                        <div class="flex items-center justify-center w-16 h-16 mb-6 text-white bg-black rounded-lg">
                            <x-heroicon-o-light-bulb class="w-8 h-8" />
                        </div>
                        <dt class="text-xl font-semibold leading-7 text-gray-900 dark:text-white">
                            Innovative Insights
                        </dt>
                        <dd class="flex flex-col flex-auto mt-4 text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Gain access to cutting-edge strategies and best practices from industry leaders and successful entrepreneurs.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <div class="flex items-center justify-center w-16 h-16 mb-6 text-white bg-black rounded-lg">
                            <x-heroicon-o-users class="w-8 h-8" />
                        </div>
                        <dt class="text-xl font-semibold leading-7 text-gray-900 dark:text-white">
                            Powerful Networking
                        </dt>
                        <dd class="flex flex-col flex-auto mt-4 text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Connect with like-minded individuals, all from the beautiful city of Cagliari, forge valuable partnerships, and expand your professional network.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <div class="flex items-center justify-center w-16 h-16 mb-6 text-white bg-black rounded-lg">
                            <x-heroicon-o-academic-cap class="w-8 h-8" />
                        </div>
                        <dt class="text-xl font-semibold leading-7 text-gray-900 dark:text-white">
                            Personalized Guidance
                        </dt>
                        <dd class="flex flex-col flex-auto mt-4 text-base leading-7 text-gray-600 dark:text-gray-300">
                            <p class="flex-auto">Receive tailored advice and mentorship from experienced entrepreneurs and industry experts to accelerate your business growth.</p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="py-24 bg-gray-50 dark:bg-gray-900">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    Upcoming Entrepreneur Group Meetings
                </h2>
                <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Mark your calendars and join us for our upcoming entrepreneur group meetings. Discover the dates, locations, and key highlights of each event.
                </p>
            </div>
            
            @if($emcEvents->isNotEmpty())
                <div class="grid max-w-2xl grid-cols-1 mx-auto mt-16 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @foreach($emcEvents->take(3) as $event)
                        <article class="flex flex-col items-start justify-between p-6 transition-shadow bg-white shadow-sm dark:bg-gray-800 rounded-2xl hover:shadow-lg">
                            @if($event->photo_path)
                                <div class="relative w-full">
                                    <img class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]" 
                                         src="{{ Storage::disk('public')->url($event->photo_path) }}" 
                                         alt="{{ $event->title }}">
                                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                            @endif
                            <div class="max-w-xl">
                                <div class="flex items-center mt-8 text-xs gap-x-4">
                                    <time datetime="{{ $event->start_date->toISOString() }}" class="text-gray-500 dark:text-gray-400">
                                        {{ $event->start_date->format('M j, Y') }}
                                    </time>
                                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                                        <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                        {{ $event->start_date->format('g:i A') }}
                                    </div>
                                </div>
                                <div class="relative group">
                                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 dark:text-white group-hover:text-gray-600 dark:group-hover:text-gray-300">
                                        <a href="{{ route('event.show', $event->slug) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $event->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3 dark:text-gray-300">
                                        {!! Str::limit(strip_tags($event->description), 150) !!}
                                    </p>
                                </div>
                                @if($event->address)
                                    <div class="flex items-center mt-4 text-sm text-gray-500 dark:text-gray-400">
                                        <x-heroicon-o-map-pin class="w-4 h-4 mr-1" />
                                        {{ Str::limit($event->address, 50) }}
                                    </div>
                                @endif
                                <div class="mt-6">
                                    <a href="{{ route('event.show', $event->slug) }}" class="text-sm font-semibold text-black dark:text-white hover:text-gray-700 dark:hover:text-gray-300">
                                        Read More <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Member Events Section -->
    @if($memberEvents->isNotEmpty())
        <section class="py-24 bg-white dark:bg-gray-800">
            <div class="px-6 mx-auto max-w-7xl lg:px-8">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        Upcoming Member Events
                    </h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                        Exclusive events for our members. Join us for networking, learning, and growth opportunities.
                    </p>
                </div>
                
                <div class="grid max-w-2xl grid-cols-1 mx-auto mt-16 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @foreach($memberEvents->take(3) as $event)
                        <article class="flex flex-col items-start justify-between p-6 transition-shadow shadow-sm bg-gray-50 dark:bg-gray-900 rounded-2xl hover:shadow-lg">
                            @if($event->photo_path)
                                <div class="relative w-full">
                                    <img class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]" 
                                         src="{{ Storage::disk('public')->url($event->photo_path) }}" 
                                         alt="{{ $event->title }}">
                                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                                </div>
                            @endif
                            <div class="max-w-xl">
                                <div class="flex items-center mt-8 text-xs gap-x-4">
                                    <time datetime="{{ $event->start_date->toISOString() }}" class="text-gray-500 dark:text-gray-400">
                                        {{ $event->start_date->format('M j, Y') }}
                                    </time>
                                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                                        <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                        {{ $event->start_date->format('g:i A') }}
                                    </div>
                                </div>
                                <div class="relative group">
                                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 dark:text-white group-hover:text-gray-600 dark:group-hover:text-gray-300">
                                        <a href="{{ route('event.show', $event->slug) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $event->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3 dark:text-gray-300">
                                        {!! Str::limit(strip_tags($event->description), 150) !!}
                                    </p>
                                </div>
                                @if($event->address)
                                    <div class="flex items-center mt-4 text-sm text-gray-500 dark:text-gray-400">
                                        <x-heroicon-o-map-pin class="w-4 h-4 mr-1" />
                                        {{ Str::limit($event->address, 50) }}
                                    </div>
                                @endif
                                <div class="mt-6">
                                    <a href="{{ route('event.show', $event->slug) }}" class="text-sm font-semibold text-black dark:text-white hover:text-gray-700 dark:hover:text-gray-300">
                                        Read More <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="bg-black">
        <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Join Our Entrepreneur Group
                </h2>
                <p class="max-w-xl mx-auto mt-6 text-lg leading-8 text-gray-300">
                    Discover a vibrant community of innovators in Cagliari. This platform offers a unique space for local entrepreneurs to connect, share insights, and foster collaboration.
                </p>
                <div class="flex items-center justify-center mt-10 gap-x-6">
                    <a href="{{ route('register') }}" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-black shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                        Join Now
                    </a>
                    <a href="{{ route('events.index') }}" class="text-sm font-semibold leading-6 text-white">
                        Learn more <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
