<script setup>
defineProps({
    event: Object,
    locale: {
        type: String,
        default: 'en'
    },
});
</script>

<template>
    <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-96">
        <div
            class="relative h-56 mx-4 -mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40">
            <img
            v-if="event.photo_path" :src="event.photo_url"
                alt="card-image" />
        </div>
        <div class="p-6">
            <h5
                class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                {{ event.title }}
            </h5>
            <div v-if="event.is_member_event"
                class="flex items-center gap-4 mb-4">
                    <div>
                        <h6 class="text-sm font-semibold">Organized by {{ event.user.name }}</h6>
                    </div>
            </div>
            <h6
                class="block mb-2 font-sans antialiased font-semibold leading-snug tracking-normal text-l text-blue-gray-800">
                {{ event.start_date }}
            </h6>
            <h6
                class="block mb-2 font-sans antialiased font-semibold leading-snug tracking-normal text-l text-blue-gray-400">
                {{ event.address }}
            </h6>
            <p class="block mb-4 overflow-y-auto font-sans text-base antialiased font-light leading-relaxed text-inherit h-60" v-html="event.description">
            </p>
            <div v-if="event.tags?.length > 0"
                class="flex flex-wrap gap-2">
                <span v-for="tag in event.tags" :key="tag.id"
                      class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-white">
                    {{ tag.name[locale] }}
                </span>
            </div>
        </div>
        <div class="p-6 pt-0">
            <a :href="route('event.show',{slug: event.slug})"
                class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                type="button">
                Read More
            </a>
        </div>
    </div>
</template>
