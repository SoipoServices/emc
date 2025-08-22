<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    @if(!$faqs->isEmpty())
        <!-- Header Section -->
        <section class="w-full py-8 bg-white shadow-sm dark:bg-gray-800 md:py-16">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-center mb-8 space-y-4 text-center">
                    <h1 class="text-2xl font-bold tracking-tighter text-gray-900 sm:text-3xl md:text-4xl lg:text-5xl dark:text-white">
                        {{ __('FAQs') }}
                    </h1>
                    <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                        Find answers to the most frequently asked questions about our services and platform.
                    </p>
                </div>
            </div>
        </section>

        <!-- FAQ Content -->
        <div class="container px-4 py-8 mx-auto">
            <div class="max-w-4xl mx-auto">
                <div class="space-y-6">
                    @foreach($faqs as $faq)
                        <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                            <div class="p-6">
                                <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">
                                    {{ $faq->question }}
                                </h3>
                                <div class="prose prose-gray dark:prose-invert max-w-none">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <section class="py-16 text-center">
            <div class="max-w-md mx-auto">
                @svg('heroicon-o-question-mark-circle','w-16 h-16 mx-auto mb-4 text-gray-400')
                <h3 class="mb-4 text-xl font-semibold text-gray-800 dark:text-white">No FAQs Available</h3>
                <p class="text-gray-600 dark:text-gray-300">There are currently no frequently asked questions available. Check back soon for helpful information!</p>
            </div>
        </section>
    @endif
</div>
