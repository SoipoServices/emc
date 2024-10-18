<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    post: Object,
});

const form = useForm({
    body: props.post.body,
});

const submit = () => {
    form.put(route('billboard.update', props.post.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout title="Edit Post">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
                Edit Post
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl dark:bg-gray-800 dark:text-white sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <textarea
                            v-model="form.body"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 dark:bg-gray-800 dark:text-white focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="3"
                            placeholder="What's on your mind?"
                        ></textarea>
                        <div v-if="form.errors.body" class="mt-1 text-red-600">{{ form.errors.body }}</div>
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 border border-transparent rounded-md dark:bg-white dark:text-gray-800 hover:bg-gray-700"
                            :disabled="form.processing"
                        >
                            Update Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
