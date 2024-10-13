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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Post
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <textarea
                            v-model="form.body"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            rows="3"
                            placeholder="What's on your mind?"
                        ></textarea>
                        <div v-if="form.errors.body" class="text-red-600 mt-1">{{ form.errors.body }}</div>
                        <button
                            type="submit"
                            class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
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
