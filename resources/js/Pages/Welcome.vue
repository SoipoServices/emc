<script setup>
import AppLayout from '@/Layouts/GuestLayout.vue';

</script>

<template>
    <AppLayout title="Welcome" :can-register="true" :can-login="true">
        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
            <div
                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
            >
                <div id="screenshot-container" class="relative flex items-stretch flex-1 w-full">
                    <img
                        src="../../images/event_pic.jpg"
                        alt="Laravel documentation screenshot"
                        class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)]"
                        @error="handleImageError"
                    />
                    <div
                        class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900">
                    </div>
                </div>

                <div class="relative flex items-center gap-6 lg:items-end">
                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">


                        <div class="pt-3 sm:pt-5 lg:pt-0">

                            <p class="mt-4 text-sm/relaxed">
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <a
                href="https://www.facebook.com/groups/6784218835040596/"
                target="_blank"
                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
            >
                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                    <v-icon name="fa-facebook" class="w-12 h-12 sm:h-10 sm:w-10" animation="wrench" fill="#FF2D20" hover/>
                </div>

                <div class="pt-3 sm:pt-5">
                    <h2 class="text-xl font-semibold text-black dark:text-white">Facebook</h2>

                    <p class="mt-4 text-sm/relaxed">
                        Discover a vibrant community of innovators in Cagliari with a dedicated Facebook group for entrepreneurs. This platform offers a unique space for local entrepreneurs to connect, share insights, and foster collaboration. Whether you're starting a new venture or looking to expand your network, this group provides valuable resources and a supportive environment to help your business thrive. Joining this group could be the stepping stone to forming lasting partnerships and exploring new opportunities in the entrepreneurial landscape of Cagliari.
                    </p>
                </div>

                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
            </a>

            <a
                href="https://www.linkedin.com/groups/9588305/"
                target="_blank"
                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
            >
                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                    <v-icon name="fa-linkedin" class="w-12 h-12 sm:h-10 sm:w-10" animation="wrench" fill="#FF2D20" hover/>
                </div>

                <div class="pt-3 sm:pt-5">
                    <h2 class="text-xl font-semibold text-black dark:text-white">LinkedIn</h2>

                    <p class="mt-4 text-sm/relaxed">
                        Welcome to the Cagliari Entrepreneurs Network on LinkedIn, a vibrant community designed to unite local entrepreneurs. This group is the perfect hub for Cagliari-based innovators looking to network, share ideas, and collaborate on exciting projects. Members can expect a supportive environment where they can connect with peers, discover potential partnerships, and explore new business opportunities. Join us to engage with fellow entrepreneurs and turn amazing possibilities into reality. Whether you're a seasoned business owner or just starting, this group aims to foster growth and success within our dynamic entrepreneurial ecosystem.
                    </p>
                </div>

                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
            </a>

        </div>

    </AppLayout>
</template>
