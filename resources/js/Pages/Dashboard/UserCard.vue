<script setup>
import ApplicationMark from "@/Components/ApplicationMark.vue";

defineProps({
    user: {
        type: Object,
        required: true
    },
    locale: {
        type: String,
        default: 'en'
    },
});
</script>
<template>
    <div >
        <div class="relative mt-16 mb-32 max-w-sm mx-auto mt-24 ">
            <div class="rounded overflow-hidden shadow-md bg-white min-h-72 dark:bg-gray-900 text-white">
                <div class="absolute -mt-20 w-full flex justify-center">
                    <div class="h-32 w-32">
                        <img v-if="user.profile_photo_url"  :src="user.profile_photo_url" :alt="user.name" class="rounded-full object-cover h-full w-full shadow-md">
                        <ApplicationMark v-else class="rounded-full object-cover h-full w-full shadow-md"/>
                    </div>
                </div>
                <div class="px-6 mt-16">
                    <h1 class="font-bold text-3xl text-center mb-1 dark:text-white">{{ user.name }}</h1>
                    <p class="text-gray-800 text-sm text-center dark:text-white" v-if="user.position">{{ user.position }}</p>
                    <p class="text-gray-800 text-sm text-center  pt-3 dark:text-white" v-if="user.telephone">
                        <v-icon name="fa-phone-alt" class="w-4 h-4" animation="wrench" hover/>
                        <a :href="'tel:'+user.telephone" >
                            {{ user.telephone }}
                        </a>
                    </p>
                    <p class="text-center text-gray-600 text-base pt-3 font-normal dark:text-white" v-if="user.bio">
                        {{user.bio}}
                    </p>
                    <div class="mx-auto flex justify-center pt-5 pb-5 text-gray-600 dark:text-white">

                        <a :href="user.site_url" class="mx-5" v-if="user.site_url">
                            <div aria-label="Site">
                                <v-icon name="fa-link" class="w-8 h-8" animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.linkedin_url" class="mx-5" v-if="user.linkedin_url">
                            <div aria-label="Linkedin">
                                <v-icon name="fa-linkedin" class="w-8 h-8" animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.youtube_url" class="mx-5" v-if="user.youtube_url">
                            <div aria-label="Youtube">
                                <v-icon name="fa-youtube" class="w-8 h-8" animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.facebook_url" class="mx-5" v-if="user.facebook_url">
                            <div aria-label="Facebook">
                                <v-icon name="fa-facebook" class="w-8 h-8" animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.twitter_url" class="mx-5 w-full" v-if="user.twitter_url">
                            <div aria-label="Twitter">
                                <v-icon name="fa-twitter" class="w-8 h-8" animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="'mailto:'+user.email" class="mx-5" v-if="user.email">
                            <div aria-label="Email">
                                <v-icon name="fa-mail-bulk" class="w-8 h-8" animation="wrench" hover/>
                            </div>
                        </a>
                    </div>
                    <div class="w-full flex flex-col justify-center pt-5 pb-5 ">
                        <div v-if="user.tags" class="mx-auto items-center justify-center">
                            <div class="badge badge-primary m-1" v-for="tag in user.tags" :key="tag.id">{{ tag.name[locale]}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

