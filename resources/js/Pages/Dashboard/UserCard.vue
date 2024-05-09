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
        <div class="relative max-w-sm mx-auto mt-16 mt-24 mb-32 ">
            <div class="overflow-hidden text-white bg-white rounded shadow-md min-h-72 dark:bg-gray-900">
                <div class="absolute flex justify-center w-full -mt-20">
                    <div class="w-32 h-32">
                        <img v-if="user.profile_photo_url"  :src="user.profile_photo_url" :alt="user.name" class="object-cover w-full h-full rounded-full shadow-md">
                        <ApplicationMark v-else class="object-cover w-full h-full rounded-full shadow-md"/>
                    </div>
                </div>
                <div class="px-6 mt-16">
                    <h1 class="mb-1 text-3xl font-bold text-center text-gray-800 dark:text-white">{{ user.name }}</h1>
                    <p class="text-sm text-center text-gray-800 dark:text-white" v-if="user.position">{{ user.position }}</p>
                    <p class="pt-3 text-sm text-center text-gray-800 dark:text-white" v-if="user.telephone">
                        <a :href="'tel:'+user.telephone" >
                            <v-icon name="fa-phone-alt" class="w-4 h-4 mr-2" animation="wrench" hover/>
                            {{ user.telephone }}
                        </a>
                    </p>

                    <p class="pt-3 text-sm text-center text-gray-800 dark:text-white" v-if="user.telephone">
                        <a :href="'mailto:'+user.email" v-if="user.email">
                            <div aria-label="Email">
                                <v-icon name="fa-mail-bulk" class="w-4 h-4 mr-2" animation="wrench" hover/>
                                {{ user.email }}
                            </div>
                        </a>
                    </p>


                    <p class="pt-3 text-base font-normal text-center text-gray-600 dark:text-white" v-if="user.bio">

                        <div class="h-32 overflow-y-auto" >
                         {{user.bio}}
                        </div>
                    </p>
                    <div class="flex justify-center pt-5 pb-5 mx-auto text-gray-600 dark:text-white">


                        <a :href="route('user.vcard',{'user':user.id})" class="mx-5" >
                            <div aria-label="Site">
                                <v-icon name="fa-download" class="w-4 h-4 " animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.site_url" class="mx-5" v-if="user.site_url">
                            <div aria-label="Site">
                                <v-icon name="fa-link" class="w-4 h-4 " animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.linkedin_profile_url" class="mx-5" v-if="user.linkedin_profile_url">
                            <div aria-label="Linkedin">
                                <v-icon name="fa-linkedin" class="w-4 h-4 " animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.youtube_url" class="mx-5" v-if="user.youtube_url">
                            <div aria-label="Youtube">
                                <v-icon name="fa-youtube" class="w-4 h-4 " animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.facebook_url" class="mx-5" v-if="user.facebook_url">
                            <div aria-label="Facebook">
                                <v-icon name="fa-facebook" class="w-4 h-4 " animation="wrench" hover/>
                            </div>
                        </a>

                        <a :href="user.twitter_url" class="mx-5" v-if="user.twitter_url">
                            <div aria-label="Twitter">
                                <v-icon name="fa-twitter" class="w-4 h-4 " animation="wrench" hover/>
                            </div>
                        </a>
                    </div>
                    <div class="flex flex-col justify-center w-full pt-5 pb-5 ">
                        <div v-if="user.tags" class="items-center justify-center mx-auto">
                            <div class="m-1 badge badge-primary" v-for="tag in user.tags" :key="tag.id">{{ tag.name[locale]}}</div>
                        </div>
                        <div v-else class="items-center justify-center mx-auto">
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

