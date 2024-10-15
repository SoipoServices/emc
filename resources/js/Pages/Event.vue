<script setup>
import AppLayout from '@/Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    title: String,
    canLogin: Boolean,
    canRegister: Boolean,
    event: Object,
    locale: {
        type: String,
        default: 'en'
    },
});
</script>

<template>
    <AppLayout :title="title" :can-register="canRegister" :can-login="canLogin">
        <section class="py-12 bg-white dark:bg-gray-900">
            <div class="container px-4 mx-auto">
                <div class="max-w-4xl mx-auto">
                    <div class="space-y-8">
                        <h2 class="text-3xl font-semibold text-gray-800 dark:text-white md:text-4xl">
                            {{ event.title }}
                        </h2>
                        <div class="overflow-hidden rounded-lg shadow-lg">
                            <img :src="event.photo_url" :alt="event.title" class="object-cover w-full h-auto">
                        </div>
                        <div class="space-y-4">
                            <div class="prose dark:prose-invert max-w-none" v-html="event.description"></div>
                            <div class="p-4 bg-gray-100 rounded-lg dark:bg-gray-800">
                                <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">Event Details</h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    <strong>Date:</strong> {{ new Date(event.start_date).toLocaleString() }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-300">
                                    <strong>Location:</strong> {{ event.address }}
                                </p>
                            </div>
                            <div class="flex justify-center gap-x-4 md:justify-start">
                                <a
                                    :href="event.link"
                                    target="_blank"
                                    class="px-6 py-3 text-white transition duration-300 ease-in-out bg-blue-600 rounded-md hover:bg-blue-700"
                                >
                                    RSVP
                                </a>
                                <Link
                                    v-if="!$page.props.auth.user"
                                    :href="route('register')"
                                    class="px-6 py-3 text-white transition duration-300 ease-in-out bg-black rounded-md"
                                >
                                    Become a member
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
