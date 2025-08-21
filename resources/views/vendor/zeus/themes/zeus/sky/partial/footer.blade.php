<footer class="bg-white dark:bg-black border-t border-gray-200 dark:border-gray-800 mt-auto">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @include($skyTheme.'.partial.logo', ["classes" => "w-6 h-6"])
                    <span class="text-lg font-bold text-gray-900 dark:text-white">{{ config('app.name') }}</span>
                </a>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Built by <a href="https://soiposervices.com" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400">SoipoServices</a>
                </span>
            </div>
            
            <div class="flex items-center gap-6">
                <nav class="flex gap-4">
                    <a href="{{ route('terms.show') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">Terms of Service</a>
                    <a href="{{ route('policy.show') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">Privacy Policy</a>
                    <a href="https://www.iubenda.com/privacy-policy/89321358/cookie-policy" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100" title="Cookie Policy">Cookie Policy</a>
                </nav>
                
                <div class="flex gap-3">
                    <a href="https://www.linkedin.com/groups/9588305/" class="text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors" target="_blank">
                        <x-fab-linkedin class="w-5 h-5" />
                    </a>
                    <a href="https://www.facebook.com/groups/6784218835040596/" class="text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors" target="_blank">
                        <x-fab-facebook-f class="w-5 h-5" />
                    </a>
                    <a href="mailto:hello@em-ca.org" class="text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>