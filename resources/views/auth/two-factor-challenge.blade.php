<x-zeus::app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="mx-auto h-12 w-auto flex justify-center">
                    <x-application-mark class="h-12 w-12" />
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                    Two Factor Authentication
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400" x-data="{ recovery: false }">
                    <span x-show="! recovery">
                        Please confirm access to your account by entering the authentication code provided by your authenticator application.
                    </span>
                    <span x-show="recovery" style="display: none;">
                        Please confirm access to your account by entering one of your emergency recovery codes.
                    </span>
                </p>
            </div>

            <form method="POST" action="{{ route('two-factor.login') }}" x-data="{ recovery: false }">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Authentication Code</label>
                    <input id="code" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm dark:bg-gray-700 mt-1" 
                           type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                    @error('code')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4" x-show="recovery" style="display: none;">
                    <label for="recovery_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Recovery Code</label>
                    <input id="recovery_code" class="appearance-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm dark:bg-gray-700 mt-1" 
                           type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                    @error('recovery_code')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline cursor-pointer"
                            x-show="! recovery"
                            x-on:click="
                                recovery = true;
                                $nextTick(() => { $refs.recovery_code.focus() })
                            ">
                        Use a recovery code
                    </button>

                    <button type="button" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline cursor-pointer"
                            x-show="recovery" style="display: none;"
                            x-on:click="
                                recovery = false;
                                $nextTick(() => { $refs.code.focus() })
                            ">
                        Use an authentication code
                    </button>

                    <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition dark:bg-indigo-500 dark:hover:bg-indigo-600">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-zeus::app-layout>
