<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    locale: {
        type: String,
        required: true
    },
    tags: {
        type: Object,
        required: false,
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
            <div class="flex input-group">
                <select v-if="tags" name="category" @change="searchUser" class="py-2 text-white bg-gray-800 rounded-l-lg dark:text-gray-700 border-inherit dark:bg-gray-200 " v-model="form.category">
                    <option selected value="">Pick a category</option>
                    <option v-for="tag in tags" :key="tag.id" :value="tag.slug[locale]"> {{ tag.name[locale] }}</option>
                </select>
                <input :class="{'rounded-l-lg': !tags}" type="search" name="search" v-model="form.search" class="w-full text-gray-800 border-inherit dark:bg-gray-800 dark:text-white"
                       placeholder="Looking for something?" />
                <button class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border-transparent rounded-r-lg dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    <v-icon name="fa-search" class="w-5 h-5" animation="wrench" hover/>
                </button>
            </div>
        </div>
    </form>
</template>
<script setup>
</script>
