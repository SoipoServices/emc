<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    events: Object, // Changed from Array to Object to accommodate pagination
    can: Object,
});
</script>

<template>
    <AppLayout title="Event List">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Event List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Upcoming Events</h3>
                        <Link :href="route('events.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            Create New Event
                        </Link>
                    </div>
                    <div v-for="event in events.data" :key="event.id" class="mb-4 p-4 border rounded">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="flex items-center">
                                    <h4 class="text-lg font-semibold mb-2">{{ event.title }}</h4>
                                    <span v-if="event.is_approved" class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                        Approved
                                    </span>
                                    <span v-else class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                        Pending Approval
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">{{ new Date(event.start_date).toLocaleString() }} - {{ new Date(event.end_date).toLocaleString() }}</p>
                                <p class="mb-4">{{ event.plain_description.substring(0, 200) }}{{ event.plain_description.length > 200 ? '...' : '' }}</p>

                                <div class="flex items-center mb-2">
                                    <img :src="event.user.profile_photo_url" :alt="event.user.name" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <p class="text-sm font-semibold">Created by {{ event.user.name }}</p>
                                        <p class="text-sm text-gray-500">{{ event.address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <img v-if="event.photo_url" :src="event.photo_url" :alt="event.title" class="w-24 h-24 object-cover rounded">
                                <div v-else class="w-24 h-24 bg-gray-200 flex items-center justify-center rounded">
                                    <span class="text-gray-500 text-xs">No Image</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            <Link
                                v-if="can.updateEvent[event.id]"
                                :href="route('events.edit', event.id)"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"
                            >
                                Edit Event
                            </Link>
                            <Link
                                :href="route('event.show', event.slug)"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                            >
                                View Event
                            </Link>
                        </div>
                    </div>
                    <Pagination :links="events.links" v-if="events.links" class="mt-6" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
