<script setup>
import AppLayout from "@/Layouts/GuestLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    title: String,
    canLogin: Boolean,
    canRegister: Boolean,
    event: Object,
    locale: {
        type: String,
        default: "en",
    },
});
</script>

<template>
    <AppLayout :title="title" :can-register="canRegister" :can-login="canLogin">
        <section class="py-12 bg-white dark:bg-gray-900">
            <div class="container px-4 mx-auto">
                <div class="max-w-6xl mx-auto">
                    <div class="flex flex-col md:flex-row md:space-x-8">
                        <div class="space-y-8 md:w-2/3">
                            <h2
                                class="text-3xl font-semibold text-gray-800 dark:text-white md:text-4xl"
                            >
                                {{ event.title }}
                            </h2>
                            <div
                                v-if="event.is_member_event"
                                class="flex items-center gap-4 mb-4"
                            >
                                <div v-if="event.user">
                                    <h6 class="text-sm font-semibold">
                                        Organized by {{ event.user.name }}
                                    </h6>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="block md:hidden">
                                    <div
                                        class="p-4 bg-gray-100 rounded-lg dark:bg-gray-800"
                                    >
                                        <h3
                                            class="mb-2 text-xl font-semibold text-gray-800 dark:text-white"
                                        >
                                            Event Details
                                        </h3>
                                        <p
                                            class="text-gray-600 dark:text-gray-300"
                                        >
                                            <strong>Date:</strong>
                                            {{
                                                new Date(
                                                    event.start_date
                                                ).toLocaleTimeString([], {
                                                    year: "numeric",
                                                    month: "numeric",
                                                    day: "numeric",
                                                    hour: "2-digit",
                                                    minute: "2-digit",
                                                })
                                            }}
                                        </p>
                                        <p
                                            class="text-gray-600 dark:text-gray-300"
                                        >
                                            <strong>Location:</strong>
                                            {{ event.address }}
                                        </p>
                                        <div
                                            class="flex justify-start mt-2 gap-x-4"
                                        >
                                            <a
                                                :href="event.link"
                                                target="_blank"
                                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors bg-gray-900 rounded-md shadow h-9 text-gray-50 hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300"
                                            >
                                                RSVP
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="prose dark:prose-invert max-w-none"
                                    v-html="event.description"
                                ></div>

                                <div
                                    v-if="event.tags?.length > 0"
                                    class="flex flex-wrap gap-2 mb-4"
                                >
                                    <span
                                        v-for="tag in event.tags"
                                        :key="tag.id"
                                        class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-white"
                                    >
                                        {{ tag.name[locale] }}
                                    </span>
                                </div>
                                <div class="flex justify-start gap-x-4">
                                    <a
                                        :href="event.link"
                                        target="_blank"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors bg-gray-900 rounded-md shadow h-9 text-gray-50 hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300"
                                    >
                                        RSVP
                                    </a>
                                    <Link
                                        v-if="!$page.props.auth.user"
                                        :href="route('register')"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-900 transition-colors bg-transparent border border-gray-900 rounded-md shadow hover:bg-gray-900 h-9 hover:text-gray-50 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:border dark:border-gray-50 dark:text-gray-50 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300"
                                    >
                                        Become a member
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 md:w-1/3 md:mt-0">
                            <div class="sticky top-8">
                                <div
                                    class="overflow-hidden rounded-lg shadow-lg"
                                >
                                    <img
                                        :src="event.photo_url"
                                        :alt="event.title"
                                        class="object-cover w-full h-auto"
                                    />
                                </div>
                            </div>
                            <div
                                class="p-4 mt-5 bg-gray-100 rounded-lg dark:bg-gray-800"
                            >
                                <h3
                                    class="mb-2 text-xl font-semibold text-gray-800 dark:text-white"
                                >
                                    Event Details
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    <strong>Date:</strong>
                                    {{
                                        new Date(
                                            event.start_date
                                        ).toLocaleTimeString([], {
                                            year: "numeric",
                                            month: "numeric",
                                            day: "numeric",
                                            hour: "2-digit",
                                            minute: "2-digit",
                                        })
                                    }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-300">
                                    <strong>Location:</strong>
                                    {{ event.address }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
