<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextArea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    site_url: props.user.site_url,
    linkedin_profile_url: props.user.linkedin_profile_url,
    bio: props.user.bio,
    position: props.user.position,
    facebook_url: props.user.facebook_url,
    twitter_url: props.user.twitter_url,
    youtube_url: props.user.youtube_url,

});


const updateBioInformation = () => {

    form.post(route('user-bio-information.update'), {
        errorBag: 'updateBioInformation',
        preserveScroll: true,
    });
};


</script>

<template>
    <FormSection @submitted="updateBioInformation">
        <template #title>
            Bio Information
        </template>

        <template #description>
            Update your account's bio information.
        </template>

        <template #form>

            <!-- position -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="position" value="Position" />
                <TextInput
                    id="position"
                    v-model="form.position"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="position"
                />
                <InputError :message="form.errors.position" class="mt-2" />
            </div>

            <!-- bio -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="bio" value="Bio" />
                <TextArea
                    id="bio"
                    v-model="form.bio"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="bio"
                />
                <InputError :message="form.errors.bio" class="mt-2" />
            </div>

            <!-- site_url -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="site_url" value="Site url" />
                <TextInput
                    id="site_url"
                    v-model="form.site_url"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="site_url"
                />
                <InputError :message="form.errors.site_url" class="mt-2" />
            </div>


            <!-- facebook_url -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="facebook_url" value="Facebook url" />
                <TextInput
                    id="facebook_url"
                    v-model="form.facebook_url"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="facebook_url"
                />
                <InputError :message="form.errors.facebook_url" class="mt-2" />
            </div>


            <!-- twitter_url -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="twitter_url" value="Twitter url" />
                <TextInput
                    id="twitter_url"
                    v-model="form.twitter_url"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="twitter_url"
                />
                <InputError :message="form.errors.twitter_url" class="mt-2" />
            </div>


            <!-- youtube_url -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="youtube_url" value="Youtube url" />
                <TextInput
                    id="youtube_url"
                    v-model="form.youtube_url"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="youtube_url"
                />
                <InputError :message="form.errors.youtube_url" class="mt-2" />
            </div>

            <!-- linkedin_profile_url -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="linkedin_profile_url" value="LinkedIn profile url" />
                <TextInput
                    id="linkedin_profile_url"
                    v-model="form.linkedin_profile_url"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="linkedin_profile_url"
                />
                <InputError :message="form.errors.linkedin_profile_url" class="mt-2" />
            </div>


        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
