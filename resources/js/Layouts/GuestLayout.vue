<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import NavLink from '@/Components/NavLink.vue';
import Footer from "@/Components/Footer.vue";

defineProps({
    title: String,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>
<template>
    <div class="flex flex-col min-h-[100dvh]">

        <Head :title="title" />
        <header class="flex items-center px-4 lg:px-6 h-14">
            <Link :href="route('dashboard')" class="flex items-center justify-center">
            <ApplicationMark class="block w-auto h-9" />
            </Link>
            <span class="sr-only">Entrepreneur Meet Cagliari</span>
            <nav class="flex gap-5 ml-auto sm:gap-6">
                <NavLink v-if="$page.props.auth.user" :href="route('dashboard')">
                    Dashboard
                </NavLink>
                <div v-else>
                    <NavLink :href="route('login')" class="mr-4">
                        Log in
                    </NavLink>

                    <NavLink v-if="canRegister" :href="route('register')">
                        Register
                    </NavLink>
                </div>
                <NavLink :href="route('events.index')">
                    Events
                </NavLink>
                <NavLink :href="route('public.businesses.index')">
                    Brands
                </NavLink>
                <a href="https://emcagliari.com/short/pVJp4" target="_blank"
                    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700">
                    Feedback
                </a>
            </nav>
        </header>
        <main class="flex-1">
            <slot />
        </main>
        <Footer />
    </div>
</template>
