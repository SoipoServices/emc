<x-zeus::app>
    <!-- Hero Section Background -->
    <section class="relative py-20 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="flex items-center justify-center min-h-screen py-12">
                <div class="w-full max-w-md space-y-8">
                    <!-- Logo and Header -->
                    <div class="text-center">
                        <div class="flex justify-center mx-auto">
                            @include('theme::partial.logo', ['classes' => "w-12 h-12"])
                        </div>
                        <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ __('Welcome back') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Sign in to your account to continue your entrepreneurial journey') }}
                        </p>
                        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}" class="font-semibold text-black dark:text-white hover:text-gray-700 dark:hover:text-gray-300">
                                {{ __('Create one here') }}
                            </a>
                        </p>
                    </div>

                    <!-- Login Form -->
                    <div class="p-8 bg-white rounded-2xl shadow-xl dark:bg-gray-800 ring-1 ring-gray-900/10 dark:ring-gray-700">
                        <form action="{{ route('login') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('Email address') }}
                                </label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" required 
                                           value="{{ old('email') }}"
                                           class="block w-full rounded-2xl border-0 py-3 px-4 text-gray-900 dark:text-white bg-white dark:bg-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black dark:focus:ring-white sm:text-sm sm:leading-6"
                                           placeholder="{{ __('Email address') }}">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">
                                    {{ __('Password') }}
                                </label>
                                <div class="mt-2">
                                    <input id="password" name="password" type="password" autocomplete="current-password" required
                                           class="block w-full rounded-2xl border-0 py-3 px-4 text-gray-900 dark:text-white bg-white dark:bg-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black dark:focus:ring-white sm:text-sm sm:leading-6"
                                           placeholder="{{ __('Password') }}">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember" name="remember" type="checkbox" 
                                           class="h-4 w-4 rounded border-gray-300 text-black focus:ring-black dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:ring-white">
                                    <label for="remember" class="ml-3 block text-sm text-gray-900 dark:text-white">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>

                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-semibold text-black hover:text-gray-700 dark:text-white dark:hover:text-gray-300">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                </div>
                            </div>

                            <div>
                                <button type="submit" 
                                        class="group relative flex w-full justify-center rounded-2xl bg-black px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:bg-white dark:text-black dark:hover:bg-gray-200 dark:focus-visible:outline-white">
                                    {{ __('Sign in') }}
                                </button>
                            </div>

                            <!-- Social Login Section -->
                            <div class="mt-6">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="bg-white dark:bg-gray-800 px-2 text-gray-500 dark:text-gray-400">{{ __('Or continue with') }}</span>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <a href="{{ route('linkedin.auth') }}" 
                                       class="group relative flex w-full justify-center rounded-2xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:focus-visible:outline-white">
                                        <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                        {{ __('Continue with LinkedIn') }}
                                    </a>
                                </div>
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
