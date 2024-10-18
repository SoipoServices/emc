<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import {useForm} from "@inertiajs/vue3";
import Search from "@/Pages/Dashboard/Search.vue";

const props = defineProps({
    events: Object, // Changed from Array to Object to accommodate pagination
    can: Object,
    search: String,
    locale: String,
});
const form = useForm({
    search: props.search,
});

</script>

<template>
    <AppLayout title="Event List">
        <template #header>
      <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Events
        </h2>
        <Search  :locale="locale" :search="form.search">
        </Search>
        <Link
              v-if="can.createEvent"
              :href="route('events.create')"
          type="submit"
          class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 border border-transparent rounded-md hover:bg-gray-700"
          :disabled="form.processing"
        >
        Create Event
        </Link>
      </div>
    </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Upcoming Events</h3>
                    </div>
                    <div v-for="event in events.data" :key="event.id" class="p-4 mb-4 border rounded">
                        <div class="flex items-start justify-between">
                            <div class="flex-grow">
                                <div class="flex items-center">
                                    <h4 class="mb-2 text-lg font-semibold">{{ event.title }}</h4>
                                    <span v-if="event.is_approved" class="px-2 py-1 ml-2 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                        Approved
                                    </span>
                                    <span v-else class="px-2 py-1 ml-2 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">
                                        Pending Approval
                                    </span>
                                </div>
                                <p class="mb-2 text-sm text-gray-600">{{ new Date(event.start_date).toLocaleString() }} - {{ new Date(event.end_date).toLocaleString() }}</p>
                                <p class="mb-4">{{ event.plain_description.substring(0, 200) }}{{ event.plain_description.length > 200 ? '...' : '' }}</p>

                                <div class="flex items-center mb-2">
                                    <img :src="event.user.profile_photo_url" :alt="event.user.name" class="w-10 h-10 mr-3 rounded-full">
                                    <div>
                                        <p class="text-sm font-semibold">Created by {{ event.user.name }}</p>
                                        <p class="text-sm text-gray-500">{{ event.address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 ml-4">
                                <img v-if="event.photo_url" :src="event.photo_url" :alt="event.title" class="object-cover w-24 h-24 rounded">
                                <div v-else class="flex items-center justify-center w-24 h-24 bg-gray-200 rounded">
                                    <span class="text-xs text-gray-500">No Image</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4 space-x-2">
                            <Link
                                v-if="can.updateEvent[event.id]"
                                :href="route('events.edit', event.id)"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25"
                            >
                                Edit Event
                            </Link>
                            <Link
                                :href="route('event.show', event.slug)"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25"
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
