<script setup>
import AppLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    title: String,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    events: {
        type: Object,
    },
    locale: {
        type: String,
        default: 'en'
    },
});
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
                            Join our entrepreneur group meetings and unlock invaluable insights,
                            networking opportunities, and personalized guidance to propel your business forward.
                        </p>
                        <div class="mt-6 space-x-4">
                            <Link v-if="canRegister" :href="route('register')"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors bg-gray-900 rounded-md shadow h-9 text-gray-50 hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300">
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
                            Gain access to cutting-edge strategies and best practices from industry leaders and
                            successful entrepreneurs.
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
        <section class="w-full py-12 bg-gray-100 md:py-24 lg:py-32 dark:bg-gray-800" v-if="events">
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
                    <div class="grid gap-4" v-for="event in events" :key="event.id">
                        <div
                            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-800 dark:bg-gray-950">

                            <a :href="event.link" target="_blank">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold">{{ event.title }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ event.address }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ event.start_date }}</p>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            {{ event.title }}
                                        </p>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            {{ event.description }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col">
                                        <img v-if="event.photo_path" :src="event.photo_url"
                                            class="inline-block w-20 h-20 mx-auto my-4 rounded-lg" />
                                        <div v-if="event.tags?.length > 0"
                                            class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800">
                                            <div v-for="tag in event.tags" :key="tag.id">{{ tag.name[locale] }}</div>
                                        </div>

                                    </div>

                                </div>

                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full py-12 border-t md:py-24 lg:py-32">
            <div class="container px-4 mx-auto md:px-6">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="pb-4 text-3xl font-bold tracking-tighter sm:text-5xl">Join Our Entrepreneur Group
                        </h2>
                        <p
                            class="max-w-[900px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                            Discover a vibrant community of innovators in Cagliari.
                            This platform offers a unique space for local entrepreneurs to connect, share insights, and
                            foster collaboration.
                            Whether you're starting a new venture or looking to expand your network, this group provides
                            valuable resources and a supportive environment to help your business thrive.
                            Joining this group could be the stepping stone to forming lasting partnerships and exploring
                            new opportunities in the entrepreneurial landscape of Cagliari.
                        </p>
                    </div>
                    <div class="w-full max-w-sm mx-auto space-y-2">
                        <Link v-if="canRegister" :href="route('register')"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors bg-gray-900 rounded-md shadow h-9 text-gray-50 hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300">
                        Join Now
                        </Link>
                    </div>
                </div>
            </div>
        </section>

    </AppLayout>
</template>
