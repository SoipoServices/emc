<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    body: '',
});

const submit = () => {
    form.post(route('billboard.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset('body'),
    });
};
</script>

<template>
    <AppLayout title="Create Post">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
                Create Post
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl dark:bg-gray-800 dark:text-white sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700 dark:text-white">Post Content</label>
                            <textarea
                                id="body"
                                v-model="form.body"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                rows="4"
                                required
                            ></textarea>
                            <p v-if="form.errors.body" class="mt-2 text-sm text-red-600">{{ form.errors.body }}</p>
                        </div>

                        <div class="mt-4">
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 dark:bg-white dark:text-gray-800"
                                :disabled="form.processing"
                            >
                                Create Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
