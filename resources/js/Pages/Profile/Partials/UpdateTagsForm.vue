<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Multiselect from 'vue-multiselect';
import axios from 'axios';

const props = defineProps({
    user: Object,
    tags: Array,
});

const allTags = ref([]);
const selectedTags = ref([]);

onMounted(async () => {
    try {
        const response = await axios.get(route('tags.index'));
        allTags.value = response.data.map(tag => ({ name: tag }));

        // Load user's existing tags
        if (props.tags) {
            selectedTags.value = props.tags?.map(tag => ({ name: tag.name.en }));
        }
    } catch (error) {
        console.error('Error fetching tags:', error);
    }
});

const form = useForm({
    tags: '',
});

const updateTags = () => {
    form.tags = selectedTags.value.map(tag => tag.name).join(', ');
    form.put(route('user-tags.update'), {
        preserveScroll: true,
        onSuccess: () => {
            // Optionally, you can add some success feedback here
        },
    });
};
</script>

<template>
    <FormSection @submitted="updateTags">
        <template #title>
            Update Tags
        </template>

        <template #description>
            Add tags to your profile to help others find you and understand your interests and expertise.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="tags" value="Tags" />
                <Multiselect
                    v-model="selectedTags"
                    :options="allTags"
                    :multiple="true"
                    :taggable="true"
                    @tag="(newTag) => allTags.push({name: newTag})"
                    placeholder="Select or type to add tags"
                    label="name"
                    track-by="name"
                />
                <InputError :message="form.errors.tags" class="mt-2" />
                <p class="mt-2 text-sm text-gray-500">Select from existing tags or type to add new ones</p>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
