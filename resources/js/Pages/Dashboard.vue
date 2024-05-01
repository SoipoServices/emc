<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UserCard from '@/Pages/Dashboard/UserCard.vue';
import Search from '@/Pages/Dashboard/Search.vue';
import Pagination from '@/Components/Pagination.vue';

import { ref } from 'vue';

const props = defineProps({
    users: {
        type: Object,
        required: true
    },
    locale: {
        type: String,
        required: true
    },
    search: {
        type: String,
    },
    tags: {
        type: Object,
        required: true
    },
});

const users = ref(props.users);

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 overflow-hidden shadow-xl sm:rounded-lg">
                    <Search class="pt-10" :tags="tags" :locale="locale" :search="search" />

                    <div class=" grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8">
                        <div v-for="user in props.users.data">
                            <UserCard :user="user" />
                        </div>
                    </div>
                    <div class="max-w-lg mx-auto py-10">
                        <div class="flex flex-wrap items-center justify-center">
                            <Pagination :items="props.users.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
