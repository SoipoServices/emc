<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    items: {
        type: Object,
        required: true
    },
})
</script>

<template>
    <div class="join" v-if="items.length > 3">
        <div v-for="item in items" >
            <Link v-if="item.url"  class="join-item btn text-white bg-gray-800 dark:bg-gray-200" :href="item.url" :class="{'btn-active' : item.active }" :key="item.id" v-html="item.label"/>
            <PrimaryButton v-else class="join-item btn bg-gray-800 dark:bg-gray-200" :key="item.id" v-html="item.label" disabled/>
        </div>
    </div>
</template>
