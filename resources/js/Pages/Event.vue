<script setup>
import AppLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Event from '@/Pages/Welcome/Event.vue';

defineProps({
    title: String,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    event: {
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

        <section class="py-12 bg-white">
            <div class="container px-4 mx-auto">
                <div class="mx-auto">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                        <div>
                            <h2 class="mb-4 text-4xl font-semibold text-gray-800"> {{ event.title }}</h2>
                            <p class="mb-6 text-lg text-gray-600" v-html="event.description"></p>

                            <div v-if="event.tags?.length > 0"
                                class="inline-block px-3 py-1 my-4 text-sm bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-white">
                                <div v-for="tag in event.tags" :key="tag.id">{{ tag.name[locale] }}</div>
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <p class="text-sm text-gray-500">Date: <span class="font-medium"> {{ event.start_date
                                        }}</span>
                                </p>
                                <p class="text-sm text-gray-500">Location: <span class="font-medium">{{ event.address
                                        }}</span>
                                </p>
                            </div>

                            <a :href="event.link"
                                class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                                type="button">
                                Get your ticket
                            </a>
                        </div>
                        <div>
                            <img class="object-cover w-full mb-6 rounded-md" v-if="event.photo_path"
                            :src="event.photo_url" :alt="event.title">
                        </div>
                    </div>

                </div>
            </div>
        </section>


    </AppLayout>
</template>
