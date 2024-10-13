<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    post: Object,
});

const form = useForm({
    body: '',
});

const linkPreview = ref(null);
const editingComment = ref(null);

const extractLinkMetadata = async () => {
    const urls = form.body.match(/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i);
    if (urls && urls.length > 0) {
        try {
            const response = await fetch(`/api/link-preview?url=${encodeURIComponent(urls[0])}`);
            linkPreview.value = await response.json();
        } catch (error) {
            console.error('Error fetching link preview:', error);
        }
    } else {
        linkPreview.value = null;
    }
};

const submitPost = () => {
    form.post(route('billboard.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('body');
            linkPreview.value = null;
        },
    });
};

const deletePost = (id) => {
    if (confirm('Are you sure you want to delete this post?')) {
        router.delete(route('posts.destroy', id), {
            preserveScroll: true,
        });
    }
};

const submitComment = (postId) => {
    form.post(route('comments.store', postId), {
        preserveScroll: true,
        onSuccess: () => form.reset('body'),
    });
};

const editComment = (comment) => {
    editingComment.value = { ...comment };
    form.body = comment.body;
};

const updateComment = (commentId) => {
    form.put(route('comments.update', commentId), {
        preserveScroll: true,
        onSuccess: () => {
            editingComment.value = null;
            form.reset('body');
        },
    });
};

const cancelEdit = () => {
    editingComment.value = null;
    form.reset('body');
};

const deleteComment = (id) => {
    if (confirm('Are you sure you want to delete this comment?')) {
        router.delete(route('comments.destroy', id), {
            preserveScroll: true,
        });
    }
};

const toggleReaction = (postId, emoji) => {
    router.post(route('posts.react', postId), { emoji }, {
        preserveScroll: true,
    });
};

const emojis = ['👍', '❤️', '😂', '😮', '😢', '😡'];
</script>

<template>
    <AppLayout :title="post ? 'Edit Post' : 'Create Post'">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ post ? 'Edit Post' : 'Create Post' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submitPost">
                        <textarea v-model="form.body" @input="extractLinkMetadata" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3" placeholder="What's on your mind?"></textarea>
                        <div v-if="linkPreview" class="p-2 mt-2 border rounded">
                            <img v-if="linkPreview.image" :src="linkPreview.image" class="object-cover w-full h-32" />
                            <h3 class="font-bold">{{ linkPreview.title }}</h3>
                            <p class="text-sm text-gray-600">{{ linkPreview.description }}</p>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 mt-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
                            {{ post ? 'Update Post' : 'Create Post' }}
                        </button>
                    </form>
                </div>

                <div v-if="post" class="mt-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-start">
                            <img :src="post.user.profile_photo_url" :alt="post.user.name" class="w-10 h-10 mr-3 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold">{{ post.user.name }}</span>
                                    <span class="text-sm text-gray-500">{{ new Date(post.created_at).toLocaleString() }}</span>
                                </div>
                                <p class="mt-2">{{ post.body }}</p>
                                <div v-if="post.link_url" class="p-2 mt-2 border rounded">
                                    <a :href="post.link_url" target="_blank" rel="noopener noreferrer">
                                        <img v-if="post.link_image" :src="post.link_image" class="object-cover w-full h-32" />
                                        <h3 class="font-bold">{{ post.link_title }}</h3>
                                        <p class="text-sm text-gray-600">{{ post.link_description }}</p>
                                    </a>
                                </div>
                                <div v-if="$page.props.auth.user.id === post.user_id" class="mt-2">
                                    <button @click="deletePost(post.id)" class="text-red-600 hover:text-red-900">Delete</button>
                                </div>
                                <div class="flex items-center mt-2 space-x-2">
                                    <button
                                        v-for="emoji in emojis"
                                        :key="emoji"
                                        @click="toggleReaction(post.id, emoji)"
                                        class="p-1 rounded hover:bg-gray-100"
                                        :class="{ 'bg-gray-100': post.reactions.some(r => r.user_id === $page.props.auth.user.id && r.emoji === emoji) }"
                                    >
                                        {{ emoji }}
                                    </button>
                                </div>
                                <div class="mt-1 text-sm text-gray-500">
                                    {{ post.reactions_count }} reactions
                                </div>
                                <div class="mt-4">
                                    <h4 class="font-bold">Comments</h4>
                                    <div v-for="comment in post.comments" :key="comment.id" class="flex items-start mt-2">
                                        <img :src="comment.user.profile_photo_url" :alt="comment.user.name" class="w-8 h-8 mr-2 rounded-full">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="font-semibold">{{ comment.user.name }}</span>
                                                <span class="text-xs text-gray-500">{{ new Date(comment.created_at).toLocaleString() }}</span>
                                            </div>
                                            <template v-if="editingComment && editingComment.id === comment.id">
                                                <form @submit.prevent="updateComment(comment.id)">
                                                    <textarea v-model="form.body" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="2"></textarea>
                                                    <div class="mt-1">
                                                        <button type="submit" class="mr-2 text-sm text-blue-600 hover:text-blue-900">Save</button>
                                                        <button @click="cancelEdit" type="button" class="text-sm text-gray-600 hover:text-gray-900">Cancel</button>
                                                    </div>
                                                </form>
                                            </template>
                                            <template v-else>
                                                <p class="text-sm">{{ comment.body }}</p>
                                                <div v-if="$page.props.auth.user.id === comment.user_id" class="mt-1">
                                                    <button @click="editComment(comment)" class="mr-2 text-xs text-blue-600 hover:text-blue-900">Edit</button>
                                                    <button @click="deleteComment(comment.id)" class="text-xs text-red-600 hover:text-red-900">Delete</button>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <form @submit.prevent="submitComment(post.id)" class="mt-2">
                                        <textarea v-model="form.body" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="2" placeholder="Add a comment..."></textarea>
                                        <button type="submit" class="mt-1 inline-flex items-center px-3 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Comment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
