<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Editor from '@tinymce/tinymce-vue';

const props = defineProps({
    tinymceApiKey: String,
});

const form = useForm({
    title: '',
    description: '',
    start_date: '',
    end_date: '',
    address: '',
    image: null,
});

const submit = () => {
    form.post(route('events.store'), {
        preserveScroll: true,
        forceFormData: true,
    });
};

const handleImageUpload = (e) => {
    const file = e.target.files[0];
    form.image = file;
};
</script>

<template>
    <AppLayout title="Create Event">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Event
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                            <input id="title" v-model="form.title" type="text" class="mt-1 block w-full" required autofocus />
                            <div v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <Editor
                                v-model="form.description"
                                :api-key="tinymceApiKey"
                                :init="{
                                    height: 300,
                                    menubar: false,
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview anchor',
                                        'searchreplace visualblocks code fullscreen',
                                        'insertdatetime media table paste code help wordcount'
                                    ],
                                    toolbar: 'undo redo | formatselect | bold italic backcolor | \
                                        alignleft aligncenter alignright alignjustify | \
                                        bullist numlist outdent indent | removeformat | help'
                                }"
                            />
                            <div v-if="form.errors.description" class="text-red-600 text-sm mt-1">{{ form.errors.description }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="start_date" class="block font-medium text-sm text-gray-700">Start Date</label>
                            <input id="start_date" v-model="form.start_date" type="datetime-local" class="mt-1 block w-full" required />
                            <div v-if="form.errors.start_date" class="text-red-600 text-sm mt-1">{{ form.errors.start_date }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="end_date" class="block font-medium text-sm text-gray-700">End Date</label>
                            <input id="end_date" v-model="form.end_date" type="datetime-local" class="mt-1 block w-full" required />
                            <div v-if="form.errors.end_date" class="text-red-600 text-sm mt-1">{{ form.errors.end_date }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="address" class="block font-medium text-sm text-gray-700">Address</label>
                            <input id="address" v-model="form.address" type="text" class="mt-1 block w-full" required />
                            <div v-if="form.errors.address" class="text-red-600 text-sm mt-1">{{ form.errors.address }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Event Image</label>
                            <input type="file" id="image" @change="handleImageUpload" accept="image/*" class="mt-1 block w-full" />
                            <div v-if="form.errors.image" class="text-red-600 text-sm mt-1">{{ form.errors.image }}</div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" :disabled="form.processing">
                                Create Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
