<script setup>
import AppLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const canRegister = true;

</script>

<template>
    <AppLayout title="Welcome" :can-register="canRegister" :can-login="true">

        <section class="w-full py-12 md:py-24 lg:py-32 border-y">
            <div class="px-4 mx-auto space-y-10 md:px-6 xl:space-y-16">
                <div class="grid max-w-[1300px] mx-auto gap-4 px-4 sm:px-6 md:px-10 md:grid-cols-2 md:gap-16">
                    <div>
                        <h1
                            class="lg:leading-tighter text-3xl py-4 font-bold tracking-tighter sm:text-4xl md:text-5xl xl:text-[3.4rem] 2xl:text-[3.75rem]">
                            Elevate Your Entrepreneurial Journey
                        </h1>
                        <p class="mx-auto max-w-[700px] text-gray-500 md:text-xl dark:text-gray-400">
                            Join our exclusive entrepreneur group meetings and unlock invaluable insights,
                            networking
                            opportunities, and personalized guidance to propel your business forward.
                        </p>
                        <div class="mt-6 space-x-4">
                            <Link v-if="canRegister" :href="route('register')" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors bg-gray-900 rounded-md shadow h-9 text-gray-50 hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300">
                            Join Now
                            </Link>
                        </div>
                    </div>
                    <div class="flex flex-col items-start space-y-4">
                        <img src="../../images/event_pic.jpg" alt="Meetup event in cagliari" @error="handleImageError"
                            width="550" height="310"
                            class="object-cover object-center mx-auto overflow-hidden aspect-video rounded-xl sm:w-full" />
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 md:py-24 lg:py-32">
            <div class="container px-4 mx-auto space-y-12 md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">Unlock Your Entrepreneurial
                            Potential</h2>
                        <p
                            class="max-w-[900px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                            Our entrepreneur group meetings offer a transformative experience, empowering you with
                            the connections, and guidance to elevate your business to new heights.
                        </p>
                    </div>
                </div>
                <div
                    class="grid items-start gap-8 mx-auto sm:max-w-4xl sm:grid-cols-2 md:gap-12 lg:max-w-5xl lg:grid-cols-3">
                    <div class="grid gap-1">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-6 h-6 text-gray-900 dark:text-gray-50">
                                <path
                                    d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5">
                                </path>
                                <path d="M9 18h6"></path>
                                <path d="M10 22h4"></path>
                            </svg>
                            <h3 class="text-lg font-bold">Innovative Insights</h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Gain access to cutting-edge strategies and best practices from industry leaders and successful entrepreneurs.
                        </p>
                    </div>
                    <div class="grid gap-1">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-6 h-6 text-gray-900 dark:text-gray-50">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <h3 class="text-lg font-bold">Powerful Networking</h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Connect with like-minded individuals, forge valuable partnerships, and expand your
                            professional
                            network.
                        </p>
                    </div>
                    <div class="grid gap-1">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-6 h-6 text-gray-900 dark:text-gray-50">
                                <path
                                    d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z">
                                </path>
                                <path
                                    d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z">
                                </path>
                                <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"></path>
                                <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"></path>
                            </svg>
                            <h3 class="text-lg font-bold">Personalized Guidance</h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Receive tailored advice and mentorship from experienced entrepreneurs and industry
                            experts
                            to
                            accelerate your business growth.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 bg-gray-100 md:py-24 lg:py-32 dark:bg-gray-800">
            <div class="container px-4 mx-auto md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">Upcoming Entrepreneur Group
                            Meetings
                        </h2>
                        <p
                            class="max-w-[900px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                            Mark your calendars and join us for our upcoming entrepreneur group meetings. Discover
                            the
                            dates,
                            locations, and key highlights of each event.
                        </p>
                    </div>
                </div>
                <div class="grid items-start max-w-5xl gap-6 py-12 mx-auto lg:grid-cols-2 lg:gap-12">
                    <div class="grid gap-4">
                        <div
                            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-800 dark:bg-gray-950">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">June 15, 2023</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">San Francisco, CA</p>
                                </div>
                                <div class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800">
                                    Networking</div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Join us for an evening of networking and idea-sharing as we explore the latest
                                trends
                                and challenges
                                in the entrepreneurial landscape.
                            </p>
                        </div>
                        <div
                            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-800 dark:bg-gray-950">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">July 20, 2023</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">New York City, NY</p>
                                </div>
                                <div class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800">
                                    Funding</div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Explore the latest funding opportunities and strategies to secure investment for
                                your
                                business. Hear
                                from successful entrepreneurs who have navigated the funding landscape.
                            </p>
                        </div>
                    </div>
                    <div class="grid gap-4">
                        <div
                            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-800 dark:bg-gray-950">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">August 10, 2023</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Chicago, IL</p>
                                </div>
                                <div class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800">
                                    Marketing</div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Discover cutting-edge marketing strategies and tactics to effectively promote your
                                business and
                                reach your target audience.
                            </p>
                        </div>
                        <div
                            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-800 dark:bg-gray-950">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold">September 5, 2023</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Seattle, WA</p>
                                </div>
                                <div class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800">
                                    Scaling</div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Learn strategies and best practices for scaling your business, including operational
                                efficiency,
                                team building, and navigating growth challenges.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 border-t md:py-24 lg:py-32">
            <div class="container px-4 mx-auto md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="pb-4 text-3xl font-bold tracking-tighter sm:text-5xl">Join Our Entrepreneur Group</h2>
                        <p
                            class="max-w-[900px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                                Discover a vibrant community of innovators in Cagliari.
                                This platform offers a unique space for local entrepreneurs to connect, share insights, and foster collaboration.
                                Whether you're starting a new venture or looking to expand your network, this group provides valuable resources and a supportive environment to help your business thrive.
                                Joining this group could be the stepping stone to forming lasting partnerships and exploring new opportunities in the entrepreneurial landscape of Cagliari.
                        </p>
                    </div>
                    <div class="w-full max-w-sm mx-auto space-y-2">
                        <Link v-if="canRegister" :href="route('register')" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors bg-gray-900 rounded-md shadow h-9 text-gray-50 hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300">
                            Join Now
                            </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
            <div
                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
            >
                <div id="screenshot-container" class="relative flex items-stretch flex-1 w-full">
                    <img
                        src="../../images/event_pic.jpg"
                        alt="Laravel documentation screenshot"
                        class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)]"
                        @error="handleImageError"
                    />
                    <div
                        class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
                    </div>
                </div>

                <div class="relative flex items-center gap-6 lg:items-end">
                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">


                        <div class="pt-3 sm:pt-5 lg:pt-0">

                            <p class="mt-4 text-sm/relaxed">
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <a
                href="https://www.facebook.com/groups/6784218835040596/"
                target="_blank"
                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
            >
                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                    <v-icon name="fa-facebook" class="w-12 h-12 sm:h-10 sm:w-10" animation="wrench" fill="#FF2D20" hover/>
                </div>

                <div class="pt-3 sm:pt-5">
                    <h2 class="text-xl font-semibold text-black dark:text-white">Facebook</h2>

                    <p class="mt-4 text-sm/relaxed">
                        Discover a vibrant community of innovators in Cagliari with a dedicated Facebook group for entrepreneurs. This platform offers a unique space for local entrepreneurs to connect, share insights, and foster collaboration. Whether you're starting a new venture or looking to expand your network, this group provides valuable resources and a supportive environment to help your business thrive. Joining this group could be the stepping stone to forming lasting partnerships and exploring new opportunities in the entrepreneurial landscape of Cagliari.
                    </p>
                </div>

                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
            </a>

            <a
                href="https://www.linkedin.com/groups/9588305/"
                target="_blank"
                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
            >
                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                    <v-icon name="fa-linkedin" class="w-12 h-12 sm:h-10 sm:w-10" animation="wrench" fill="#FF2D20" hover/>
                </div>

                <div class="pt-3 sm:pt-5">
                    <h2 class="text-xl font-semibold text-black dark:text-white">LinkedIn</h2>

                    <p class="mt-4 text-sm/relaxed">
                        Welcome to the Cagliari Entrepreneurs Network on LinkedIn, a vibrant community designed to unite local entrepreneurs. This group is the perfect hub for Cagliari-based innovators looking to network, share ideas, and collaborate on exciting projects. Members can expect a supportive environment where they can connect with peers, discover potential partnerships, and explore new business opportunities. Join us to engage with fellow entrepreneurs and turn amazing possibilities into reality. Whether you're a seasoned business owner or just starting, this group aims to foster growth and success within our dynamic entrepreneurial ecosystem.
                    </p>
                </div>

                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
            </a>

        </div> -->

    </AppLayout>
</template>
