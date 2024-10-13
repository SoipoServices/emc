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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Event
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
                            <img v-if="event.photo_url" :src="event.photo_url" alt="Current event image" class="mt-2 h-32 object-cover" />
                            <div v-if="form.errors.image" class="text-red-600 text-sm mt-1">{{ form.errors.image }}</div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700" :disabled="form.processing">
                                Update Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
