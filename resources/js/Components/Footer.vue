<template>
    <footer class="flex flex-col items-center w-full gap-2 px-4 py-6 border-t sm:flex-row shrink-0 md:px-6">
        <p class="flex text-xs text-gray-500 dark:text-gray-400">

            <Link :href="route('home')"
                class="items-center justify-center mb-5 text-2xl font-semibold text-gray-900 dark:text-white">
            <ApplicationMark class="w-auto h-6 " />
            </Link>
            <span class="mt-1 ml-4 text-sm text-center text-gray-500 dark:text-gray-400"> Built by <a
                    href="https://soiposervices.com" target="_blank"
                    class="text-purple-600 hover:underline dark:text-purple-500">SoipoServices</a>.</span>

        </p>
        <nav class="flex gap-4 sm:ml-auto sm:gap-6">

            <a target="_blank" :href="route('terms.show')" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms of Service</a>
            <a target="_blank" :href="route('policy.show')" class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy Policy</a>
            <a href="https://www.iubenda.com/privacy-policy/89321358/cookie-policy" class="text-xs hover:underline underline-offset-4 iubenda-white iubenda-noiframe iubenda-embed " title="Cookie Policy ">Cookie Policy</a>

            <a href="https://www.linkedin.com/groups/9588305/"
                class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400" target="_blank">
                <v-icon name="fa-linkedin" class="w-5 h-5" animation="wrench" hover />
            </a>
            <a href="https://www.facebook.com/groups/6784218835040596/"
                class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400" target="_blank">
                <v-icon name="fa-facebook" class="w-5 h-5" animation="wrench" hover />
            </a>

            <a href="mailto:hello@em-ca.org"
                class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                <v-icon name="fa-mail-bulk" class="w-5 h-5" animation="wrench" hover />
            </a>
        </nav>
    </footer>

</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
</script>
