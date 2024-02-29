<x-guest-layout>


    <div class="py-12">
        <div class="mx-auto mt-10 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">

                <div class="w-full bg-center bg-cover" style="background-image: url({{ asset('/images/emc.jpg') }});">
                    <div class="flex items-center justify-center w-full h-full py-12 bg-gray-900 bg-opacity-50">
                        <div class="text-center">
                            <div class="container px-4 mx-auto">
                                <div class="max-w-4xl mx-auto text-center">
                                    <h1 class="mt-8 mb-6 text-4xl font-bold text-gray-100 lg:text-5xl">
                                        {{ config('app.name') }}</h1>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <x-welcome />


                @if (Route::has('login'))
                    <div class="w-64 p-10 mx-auto">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-white bg-red-900 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-white bg-red-900 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="text-white bg-red-900 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-guest-layout>
