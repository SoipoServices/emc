<template>
    <footer class="text-center text-sm text-black dark:text-white/70">
        <div class="max-w-screen-xl p-4 py-6 mx-auto lg:py-16 md:p-8 lg:p-10">
            <!--                        <div class="grid grid-cols-2 gap-8 md:grid-cols-3 lg:grid-cols-5">-->
            <!--                            <div>-->
            <!--                                <h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h3>-->
            <!--                                <ul class="text-gray-500 dark:text-gray-400">-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class=" hover:underline" target="_blank">About</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Careers</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Brand Center</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Blog</a>-->
            <!--                                    </li>-->
            <!--                                </ul>-->
            <!--                            </div>-->
            <!--                            <div>-->
            <!--                                <h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Help center</h3>-->
            <!--                                <ul class="text-gray-500 dark:text-gray-400">-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Discord Server</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Twitter</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Facebook-->
            <!--                                        </a></li><a class="hover:underline" target="_blank">-->
            <!--                                </a><li class="mb-4"><a class="hover:underline" target="_blank">-->
            <!--                                </a><a class="hover:underline" target="_blank">Contact Us</a>-->
            <!--                                </li>-->
            <!--                                </ul>-->
            <!--                            </div>-->
            <!--                            <div>-->
            <!--                                <h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h3>-->
            <!--                                <ul class="text-gray-500 dark:text-gray-400">-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Privacy Policy</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Licensing</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Terms</a>-->
            <!--                                    </li>-->
            <!--                                </ul>-->
            <!--                            </div>-->
            <!--                            <div>-->
            <!--                                <h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Company</h3>-->
            <!--                                <ul class="text-gray-500 dark:text-gray-400">-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class=" hover:underline" target="_blank">About</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Careers</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Brand Center</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Blog</a>-->
            <!--                                    </li>-->
            <!--                                </ul>-->
            <!--                            </div>-->
            <!--                            <div>-->
            <!--                                <h3 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Download</h3>-->
            <!--                                <ul class="text-gray-500 dark:text-gray-400">-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">iOS</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Android</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">Windows</a>-->
            <!--                                    </li>-->
            <!--                                    <li class="mb-4">-->
            <!--                                        <a class="hover:underline" target="_blank">MacOS</a>-->
            <!--                                    </li>-->
            <!--                                </ul>-->
            <!--                            </div>-->
            <!--                        </div>-->
<!--            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">-->
            <div class="text-center">

                <Link :href="route('home')" class="flex items-center justify-center mb-5 text-2xl font-semibold text-gray-900 dark:text-white">
                    <ApplicationMark class="block h-10 lg:h-12 w-auto" />
                </Link>
                <span class="block text-sm text-center text-gray-500 dark:text-gray-400"> Built by <a href="https://soiposervices.com" target="_blank" class="text-purple-600 hover:underline dark:text-purple-500">SoipoServices</a>.
</span>
                <ul class="flex justify-center mt-5 space-x-5">
                    <li>
                        <a href="https://www.linkedin.com/groups/9588305/" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400" target="_blank">
                            <v-icon name="fa-linkedin" class="w-5 h-5" animation="wrench"  hover/>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/groups/6784218835040596/" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400" target="_blank">
                            <v-icon name="fa-facebook" class="w-5 h-5" animation="wrench"  hover/>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:hello@em-ca.org" class="text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                            <v-icon name="fa-mail-bulk" class="w-5 h-5" animation="wrench"  hover/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</template>
<script setup>
import {Link} from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
</script>
