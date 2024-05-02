<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    locale: {
        type: String,
        required: true
    },
    tags: {
        type: Object,
        required: true,
    },
    search: {
        type: String,
    },
});

const form = useForm({
    search: props.search,
    category: "",
});

const searchUser = () => {
    form.post(route('dashboard'), {
        errorBag: 'dashboard',
        preserveScroll: true,
    });
};


</script>
<template>
    <form class="max-w-lg mx-auto" @submitted="searchUser">
        <div class="form-control ">
            <div class="input-group flex">
                <select name="category" class="py-2 rounded-l-lg border-inherit  bg-gray-800 dark:bg-gray-200 text-white " v-model="form.category">
                    <option selected value="">Pick a category</option>
                    <option v-for="tag in tags" :key="tag.id" :value="tag.slug[locale]"> {{ tag.name[locale] }}</option>
                </select>
                <input type="search" name="search" v-model="form.search" class="w-full border-inherit text-gray-800 dark:bg-gray-900 dark:text-white"
                       placeholder="Search for something..." />
                <button class="py-2 px-4  inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200  border-transparent rounded-r-lg font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <v-icon name="fa-search" class="w-5 h-5" animation="wrench" hover/>
                </button>
            </div>
        </div>
    </form>
</template>
<script setup>
</script>
