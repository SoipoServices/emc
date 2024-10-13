<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    post: Object,
    can: Object,
});

const form = useForm({
    body: '',
    emoji: null,
});

const editingComment = ref(null);

const submitComment = () => {
    form.post(route('comments.store', props.post.id), {
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
        form.delete(route('comments.destroy', id), {
            preserveScroll: true,
        });
    }
};

const toggleReaction = (emoji) => {
    form.emoji = emoji;
    form.post(route('posts.react', props.post.id), {
        preserveScroll: true,
    });
};

const emojis = ['👍', '❤️', '😂', '😮', '😢', '😡'];
</script>

<template>
    <AppLayout :title="'Post by ' + post.user.name">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Post Details
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="mb-6">
                        <div class="flex items-center mb-4">
                            <img :src="post.user.profile_photo_url" :alt="post.user.name" class="w-12 h-12 mr-4 rounded-full">
                            <div>
                                <h3 class="text-lg font-bold">{{ post.user.name }}</h3>
                                <p class="text-gray-500">{{ new Date(post.created_at).toLocaleString() }}</p>
                            </div>
                        </div>
                        <p class="mb-4 text-lg">{{ post.body }}</p>
                        <div v-if="post.link_url" class="p-4 mb-4 border rounded">
                            <a :href="post.link_url" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
                                <h4 class="font-bold">{{ post.link_title }}</h4>
                                <p class="text-sm text-gray-600">{{ post.link_description }}</p>
                            </a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                v-for="emoji in emojis"
                                :key="emoji"
                                @click="toggleReaction(emoji)"
                                class="p-1 rounded hover:bg-gray-100"
                                :class="{ 'bg-gray-100': post.reactions.some(r => r.user_id === $page.props.auth.user.id && r.emoji === emoji) }"
                            >
                                {{ emoji }}
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">{{ post.reactions_count }} reactions</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="mb-4 text-lg font-bold">Comments</h4>
                        <div v-for="comment in post.comments" :key="comment.id" class="p-4 mb-4 rounded bg-gray-50">
                            <div class="flex items-start">
                                <img :src="comment.user.profile_photo_url" :alt="comment.user.name" class="w-8 h-8 mr-3 rounded-full">
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold">{{ comment.user.name }}</span>
                                        <span class="text-sm text-gray-500">{{ new Date(comment.created_at).toLocaleString() }}</span>
                                    </div>
                                    <template v-if="editingComment && editingComment.id === comment.id">
                                        <form @submit.prevent="updateComment(comment.id)">
                                            <textarea v-model="form.body" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="2"></textarea>
                                            <div class="mt-2">
                                                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Save</button>
                                                <button @click="cancelEdit" type="button" class="px-4 py-2 ml-2 text-gray-700 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                                            </div>
                                        </form>
                                    </template>
                                    <template v-else>
                                        <p class="mt-1">{{ comment.body }}</p>
                                        <div v-if="$page.props.auth.user.id === comment.user_id" class="mt-2">
                                            <button @click="editComment(comment)" class="mr-2 text-blue-600 hover:underline">Edit</button>
                                            <button @click="deleteComment(comment.id)" class="text-red-600 hover:underline">Delete</button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form @submit.prevent="submitComment">
                        <textarea v-model="form.body" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="3" placeholder="Add a comment..."></textarea>
                        <button type="submit" class="px-4 py-2 mt-2 text-white bg-blue-500 rounded hover:bg-blue-600" :disabled="form.processing">
                            Post Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
