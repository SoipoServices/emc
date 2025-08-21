<x-zeus::app>
    <!-- Hero Section Background -->
    <section class="relative py-20 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="flex items-center justify-center min-h-screen py-12">
                <div class="w-full max-w-md space-y-8">
                    <!-- Logo and Header -->
                    <div class="text-center">
                        <div class="flex justify-center mx-auto">
                            <x-application-mark class="w-16 h-16" />
                        </div>
                        <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Forgot your password?
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                        </p>
                        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                            Remember your password?
                            <a href="{{ route('login') }}" class="font-semibold text-black dark:text-white hover:text-gray-700 dark:hover:text-gray-300">
                                Sign in here
                            </a>
                        </p>
                    </div>

                    <!-- Reset Form -->
                    <div class="p-8 bg-white rounded-2xl shadow-xl dark:bg-gray-800 ring-1 ring-gray-900/10 dark:ring-gray-700">
                        <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    Email address
                                </label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" required 
                                           value="{{ old('email') }}"
                                           class="block w-full rounded-2xl border-0 py-3 px-4 text-gray-900 dark:text-white bg-white dark:bg-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black dark:focus:ring-white sm:text-sm sm:leading-6"
                                           placeholder="Email address">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <button type="submit" 
                                        class="group relative flex w-full justify-center rounded-2xl bg-black px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:bg-white dark:text-black dark:hover:bg-gray-200 dark:focus-visible:outline-white">
                                    Email Password Reset Link
                                </button>
                            </div>
                        </form>

                        <!-- Status Messages -->
                        @if (session('status'))
                            <div class="mt-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-200">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('flash.banner'))
                            <div class="mt-4 p-4 text-sm rounded-lg {{ session('flash.bannerStyle') === 'danger' ? 'text-red-800 bg-red-100 dark:bg-red-900 dark:text-red-200' : 'text-green-800 bg-green-100 dark:bg-green-900 dark:text-green-200' }}">
                                {{ session('flash.banner') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-zeus::app>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                        Back to login
                    </a>
                </div>
            </form>

            @if (session('status'))
                <div class="rounded-md bg-green-50 dark:bg-green-900 p-4 mt-4">
                    <div class="text-sm text-green-700 dark:text-green-300">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-zeus::app>
