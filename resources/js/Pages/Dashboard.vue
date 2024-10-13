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
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-gray-200 bg-opacity-25 shadow-xs dark:bg-gray-800 sm:rounded-lg">
                    <Search class="pt-10" :tags="tags" :locale="locale" :search="search" />

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-4 lg:gap-8 lg:p-8">
                        <div v-for="user in props.users.data" :key="user.id">
                            <UserCard :user="user" />
                        </div>
                    </div>
                    <div class="px-4 py-10 mx-auto sm:px-6 lg:px-8">
                        <div class="flex flex-wrap items-center justify-center">
                            <Pagination  :links="props.users.links" v-if="props.users.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>
.truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>
