<script setup>
import AppLayout from '@/Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    title: String,
    canLogin: Boolean,
    canRegister: Boolean,
    events: Array,
});
</script>

<template>
    <AppLayout :title="title" :can-login="canLogin" :can-register="canRegister">
        <section class="w-full py-8 bg-gray-100 md:py-16 lg:py-24 dark:bg-gray-800">
            <div class="container px-4 mx-auto">
                <div class="flex flex-col items-center justify-center mb-8 space-y-4 text-center">
                    <h2 class="text-2xl font-bold tracking-tighter text-gray-900 sm:text-3xl md:text-4xl lg:text-5xl dark:text-white">
                        Upcoming Events
                    </h2>
                    <p class="max-w-2xl text-sm text-gray-600 dark:text-gray-300 md:text-base lg:text-lg">
                        Join us for our upcoming entrepreneur group meetings and member events. Discover
                        the dates, locations, and key highlights of each event.
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="event in events" :key="event.id" class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-700">
                        <img v-if="event.photo_url" :src="event.photo_url" :alt="event.title" class="object-cover w-full h-48">
                        <div class="p-4">
                            <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">{{ event.title }}</h3>
                            <p class="mb-2 text-sm text-gray-600 dark:text-gray-300">
                                {{ new Date(event.start_date).toLocaleDateString() }}
                            </p>
                            <p class="mb-4 text-gray-700 dark:text-gray-200">
                                {{ event.plain_description.substring(0, 100) }}{{ event.plain_description.length > 100 ? '...' : '' }}
                            </p>
                            <div v-if="event.tags?.length > 0" class="flex flex-wrap gap-2 mb-4">
                                <span v-for="tag in event.tags" :key="tag.id"
                                      class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-white">
                                    {{ tag.name[$page.props.locale] }}
                                </span>
                            </div>
                            <Link :href="route('event.show', event.slug)" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors bg-gray-900 rounded-md shadow h-9 text-gray-50 hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300">
                                Read More
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>
.container {
    width: 100%;
    max-width: 1280px;
    margin-left: auto;
    margin-right: auto;
}
</style>
