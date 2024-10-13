<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    posts: Array,
});

const emojis = ['👍', '❤️', '😂', '😮', '😢', '😡'];

const getReactionCounts = (post) => {
    return emojis.map(emoji => ({
        emoji,
        count: post.reactions.filter(r => r.emoji === emoji).length
    })).filter(r => r.count > 0);
};
</script>

<template>
    <AppLayout title="Billboard List">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Billboard List
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Recent Posts</h3>
                        <Link :href="route('billboard.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            Create New Post
                        </Link>
                    </div>
                    <div v-for="post in posts" :key="post.id" class="mb-4 p-4 border rounded">
                        <p class="mt-2 mb-4">{{ post.body }}</p>

                        <!-- Link Preview -->
                        <div v-if="post.link_preview && post.link_preview.url" class="mt-2 mb-4 p-2 border rounded">
                            <a :href="post.link_preview.url" target="_blank" rel="noopener noreferrer" class="flex items-start">
                                <img v-if="post.link_preview.image" :src="post.link_preview.image" alt="Link preview" class="w-24 h-24 object-cover mr-4">
                                <div>
                                    <h3 class="font-bold">{{ post.link_preview.title }}</h3>
                                    <p class="text-sm text-gray-600">{{ post.link_preview.description }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center">
                                <img :src="post.user.profile_photo_url" :alt="post.user.name" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <h4 class="text-lg font-semibold">{{ post.user.name }}</h4>
                                    <span class="text-sm text-gray-500">{{ new Date(post.created_at).toLocaleString() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 flex items-center space-x-2">
                            <span v-for="reaction in getReactionCounts(post)" :key="reaction.emoji" class="text-sm">
                                {{ reaction.emoji }} {{ reaction.count }}
                            </span>
                        </div>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-sm text-gray-500">{{ post.comments_count }} comments</span>
                            <Link
                                :href="route('billboard.show', post.id)"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                            >
                                Read more
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
