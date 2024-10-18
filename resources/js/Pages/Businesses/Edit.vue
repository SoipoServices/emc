
<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Editor from "@tinymce/tinymce-vue";

const props = defineProps({
    business: Object,
  tinymceApiKey: String,
});

const form = useForm({
  name: props.business.name,
  url: props.business.url,
  linkedin_url: props.business.url,
  telephone: props.business.telephone,
  email: props.business.email,
  description: props.business.description,
  image: null,
  is_public: props.business.is_public,
  _method: 'PUT',
});

const submit = () => {
  form.post(route("businesses.update", props.business.id), {
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
  <app-layout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
        Edit Business
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 dark:text-white sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:text-white">
            <form @submit.prevent="submit">
              <div class="mb-6">
                <label
                  class="block mb-2 text-xs font-bold text-gray-700 uppercase dark:text-white"
                  for="name"
                >
                  Name *
                </label>
                <input
                  v-model="form.name"
                  class="w-full p-2 border border-gray-400 dark:bg-gray-800 dark:text-white"
                  type="text"
                  name="name"
                  id="name"
                  required
                />
                <div v-if="form.errors.name" class="mt-1 text-xs text-red-500">
                  {{ form.errors.name }}
                </div>
              </div>

              <div class="mb-6">
                <label
                  class="block mb-2 text-xs font-bold text-gray-700 uppercase dark:text-white"
                  for="url"
                >
                  Website URL
                </label>
                <input
                  v-model="form.url"
                  class="w-full p-2 border border-gray-400 dark:bg-gray-800 dark:text-white"
                  type="url"
                  name="url"
                  id="url"
                />
                <div v-if="form.errors.url" class="mt-1 text-xs text-red-500">
                  {{ form.errors.url }}
                </div>
              </div>

              <div class="mb-6">
                <label
                  class="block mb-2 text-xs font-bold text-gray-700 uppercase dark:text-white"
                  for="linkedin_url"
                >
                  LinkedIn URL
                </label>
                <input
                  v-model="form.linkedin_url"
                  class="w-full p-2 border border-gray-400 dark:bg-gray-800 dark:text-white"
                  type="url"
                  name="linkedin_url"
                  id="linkedin_url"
                />
                <div
                  v-if="form.errors.linkedin_url"
                  class="mt-1 text-xs text-red-500"
                >
                  {{ form.errors.linkedin_url }}
                </div>
              </div>

              <div class="mb-6">
                <label
                  class="block mb-2 text-xs font-bold text-gray-700 uppercase dark:text-white"
                  for="photo_path"
                >
                  Photo
                </label>
                <input
                  type="file"
                  id="image"
                  @change="handleImageUpload"
                  accept="image/*"
                  class="block w-full mt-1"
                />
                <div
                  v-if="form.errors.photo_path"
                  class="mt-1 text-xs text-red-500"
                >
                  {{ form.errors.photo_path }}
                </div>
              </div>

              <div class="mb-6">
                <label
                  class="block mb-2 text-xs font-bold text-gray-700 uppercase dark:text-white"
                  for="telephone"
                >
                  Telephone
                </label>
                <input
                  v-model="form.telephone"
                  class="w-full p-2 border border-gray-400 dark:bg-gray-800 dark:text-white"
                  type="tel"
                  name="telephone"
                  id="telephone"
                />
                <div
                  v-if="form.errors.telephone"
                  class="mt-1 text-xs text-red-500"
                >
                  {{ form.errors.telephone }}
                </div>
              </div>

              <div class="mb-6">
                <label
                  class="block mb-2 text-xs font-bold text-gray-700 uppercase dark:text-white"
                  for="email"
                >
                  Email
                </label>
                <input
                  v-model="form.email"
                  class="w-full p-2 border border-gray-400 dark:bg-gray-800 dark:text-white"
                  type="email"
                  name="email"
                  id="email"
                />
                <div v-if="form.errors.email" class="mt-1 text-xs text-red-500">
                  {{ form.errors.email }}
                </div>
              </div>


              <div class="mb-6">
                <label
                  class="block text-gray-700 uppercase cursor-pointer dark:text-white label"
                  for="is_public"
                >
                  <span class="mr-2 label-text">Public</span>
                  <input
                    type="checkbox"
                    name="is_public"
                    id="is_public"
                    checked="checked"
                    v-model="form.is_public"
                    class="checkbox checkbox-primary"
                  />
                </label>
                <div
                  v-if="form.errors.is_public"
                  class="mt-1 text-xs text-red-500"
                >
                  {{ form.errors.is_public }}
                </div>
              </div>


              <div class="mb-6">
                <label
                  class="block mb-2 text-xs font-bold text-gray-700 uppercase dark:text-white"
                  for="description"
                >
                  Description
                </label>
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
                <div
                  v-if="form.errors.description"
                  class="mt-1 text-xs text-red-500"
                >
                  {{ form.errors.description }}
                </div>
              </div>

              <div class="mb-6">
                <button
                  type="submit"
                  class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 border border-transparent rounded-md hover:bg-gray-700"
                  >
                  Edit Business
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>


