<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Editor from '@tinymce/tinymce-vue';

const props = defineProps({
    event: Object,
    tinymceApiKey: String,
});

// Function to format date to YYYY-MM-DDTHH:mm
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toISOString().slice(0, 16);
};

const form = useForm({
    title: props.event.title,
    description: props.event.description,
    start_date: formatDate(props.event.start_date),
    end_date: formatDate(props.event.end_date),
    address: props.event.address,
    image: null,
    _method: 'PUT',
});

const submit = () => {
    form.post(route('events.update', props.event.id), {
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
    <AppLayout title="Edit Event">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
                Edit Event
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl dark:bg-gray-800 dark:text-white sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-white">Title</label>
                            <input id="title" v-model="form.title" type="text" class="block w-full mt-1 dark:bg-gray-800 dark:text-white" required autofocus />
                            <div v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-white">Description</label>
                            <Editor
                             class="dark:bg-gray-800 dark:text-white"
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
                            <div v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-white">Start Date</label>
                            <input id="start_date" v-model="form.start_date" type="datetime-local" class="block w-full mt-1 dark:bg-gray-800 dark:text-white" required />
                            <div v-if="form.errors.start_date" class="mt-1 text-sm text-red-600">{{ form.errors.start_date }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-white">End Date</label>
                            <input id="end_date" v-model="form.end_date" type="datetime-local" class="block w-full mt-1 dark:bg-gray-800 dark:text-white" required />
                            <div v-if="form.errors.end_date" class="mt-1 text-sm text-red-600">{{ form.errors.end_date }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-white">Address</label>
                            <input id="address" v-model="form.address" type="text" class="block w-full mt-1 dark:bg-gray-800 dark:text-white" required />
                            <div v-if="form.errors.address" class="mt-1 text-sm text-red-600">{{ form.errors.address }}</div>
                        </div>

                        <div class="mt-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-white">Event Image</label>
                            <input type="file" id="image" @change="handleImageUpload" accept="image/*" class="block w-full mt-1" />
                            <img v-if="event.photo_url" :src="event.photo_url" alt="Current event image" class="object-cover h-32 mt-2" />
                            <div v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 border border-transparent rounded-md dark:bg-white dark:text-gray-800 hover:bg-gray-700" :disabled="form.processing">
                                Update Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
