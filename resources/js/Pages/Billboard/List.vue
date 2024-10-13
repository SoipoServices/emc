<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    posts: Object, // Changed from Array to Object to accommodate pagination
});

const emojis = ['👍', '❤️', '😂', '😮', '😢', '😡','🚀','🧨'];

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
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Billboard List
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Recent Posts</h3>
                        <Link :href="route('billboard.create')" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
                            Create New Post
                        </Link>
                    </div>
                    <div v-for="post in posts.data" :key="post.id" class="p-4 mb-4 border rounded">
                        <p class="mt-2 mb-4">{{ post.body }}</p>

                        <!-- Link Preview -->
                        <div v-if="post.link_preview && post.link_preview.url" class="p-2 mt-2 mb-4 border rounded">
                            <a :href="post.link_preview.url" target="_blank" rel="noopener noreferrer" class="flex items-start">
                                <img v-if="post.link_preview.image" :src="post.link_preview.image" alt="Link preview" class="object-cover w-24 h-24 mr-4">
                                <div>
                                    <h3 class="font-bold">{{ post.link_preview.title }}</h3>
                                    <p class="text-sm text-gray-600">{{ post.link_preview.description }}</p>
                                </div>
                            </a>
                        </div>

                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center">
                                <img :src="post.user.profile_photo_url" :alt="post.user.name" class="w-10 h-10 mr-3 rounded-full">
                                <div>
                                    <h4 class="text-lg font-semibold">{{ post.user.name }}</h4>
                                    <span class="text-sm text-gray-500">{{ new Date(post.created_at).toLocaleString() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-2 space-x-2">
                            <span v-for="reaction in getReactionCounts(post)" :key="reaction.emoji" class="text-sm">
                                {{ reaction.emoji }} {{ reaction.count }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-sm text-gray-500">{{ post.comments_count }} comments</span>
                            <div>
                                <Link
                                    v-if="$page.props.auth.user.id === post.user_id"
                                    :href="route('billboard.edit', post.id)"
                                    class="inline-flex items-center px-4 py-2 mr-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25"
                                >
                                    Edit
                                </Link>
                                <Link
                                    :href="route('billboard.show', post.id)"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25"
                                >
                                    Read more
                                </Link>
                            </div>
                        </div>
                    </div>
                    <Pagination :links="posts.links" v-if="posts.links" class="mt-6" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
