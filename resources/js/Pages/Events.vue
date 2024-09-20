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
        <section class="w-full py-12 bg-gray-100 md:py-24 lg:py-32 dark:bg-gray-800" v-if="events">
            <div class="container mx-auto">
                <div class="flex flex-col items-center justify-center space-y-4 text-center">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">Upcoming Entrepreneur Group Meetings and Member events
                        </h2>
                        <p
                            class="max-w-[900px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                            Mark your calendars and join us for our upcoming entrepreneur group meetings and member events. Discover
                            the dates, locations, and key highlights of each event.
                        </p>
                    </div>
                </div>
                <div class="grid items-start gap-6 py-12 mx-auto lg:grid-cols-3 lg:gap-2">
                    <div class="grid gap-4" v-for="event in events" :key="event.id">
                        <Event :event="event" :locale="locale" />
                    </div>
                </div>
            </div>
        </section>

    </AppLayout>
</template>
