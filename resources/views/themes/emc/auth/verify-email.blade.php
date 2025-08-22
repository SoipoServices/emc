<x-theme::app>
    <div class="flex items-center justify-center min-h-screen px-4 py-12 bg-gray-50 dark:bg-gray-900 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <div class="flex justify-center w-auto h-12 mx-auto">
                    @include('theme::partial.logo', ['classes' => "w-12 h-12"])
                </div>
                <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 dark:text-white">
                    Verify your email address
                </h2>
                <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-400">
                    Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="p-4 rounded-md bg-green-50 dark:bg-green-900">
                    <div class="text-sm text-green-700 dark:text-green-300">
                        A new verification link has been sent to the email address you provided in your profile settings.
                    </div>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" 
                            class="flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                        Resend Verification Email
                    </button>
                </form>

                <div>
                    <a href="{{ route('profile') }}" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Edit Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="ml-2 text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-theme::app>
