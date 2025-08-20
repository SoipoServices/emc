<header x-data="{ open: false }" class="px-4 bg-white dark:bg-black">
    <div class="container mx-auto">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex items-center flex-shrink-0">
                    <a class="flex gap-2 italic group" href="{{ url('/') }}">
                         @include($skyTheme.'.partial.logo')
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex sm:items-center">
                    {{--Navigation Links--}}
                </div>

            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                {{--Account menu and other icons--}}
            </div>
        </div>
    </div>
</header>

<header class="bg-gray-100 dark:bg-gray-800">
        <div class="container px-3 py-2 mx-auto">
            <div class="flex items-center justify-between">
                <div class="w-full">
                    @if(isset($breadcrumbs))
                        <nav class="my-1 font-bold text-gray-400" aria-label="Breadcrumb">
                            <ol class="inline-flex p-0 list-none">
                                {{ $breadcrumbs }}
                            </ol>
                        </nav>
                    @endif
                    @if(isset($header))
                        <div class="text-xl italic font-semibold text-gray-600 dark:text-gray-100">
                            {{ $header }}
                        </div>
                    @endif
                </div>
                <span class="bolt-loading animate-pulse"></span>
            </div>
        </div>
    </header>