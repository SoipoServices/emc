<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
  title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  router.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};

const logout = () => {
  router.post(route("logout"));
};
</script>

<template>
  <div>

    <Head :title="title" />

    <Banner />

    <!-- Modify this block to check if flash and banner exist -->
    <div v-if="$page.props.flash && $page.props.flash.banner" class="bg-indigo-600">
      <div class="px-3 py-3 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between">
          <div class="flex items-center flex-1 w-0">
            <span class="flex p-2 rounded-lg" :class="$page.props.flash.bannerStyle === 'success'
              ? 'bg-indigo-800'
              : 'bg-red-800'
              ">
              <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
              </svg>
            </span>
            <p class="ml-3 font-medium text-white truncate">
              <span>{{ $page.props.flash.banner }}</span>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="min-h-screen">
      <nav class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="flex items-center shrink-0">
                <Link :href="route('home')">
                <ApplicationMark class="block w-auto h-9" />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                  Dashboard
                </NavLink>
                <!-- Add Billboard Link -->
                <NavLink :href="route('billboard.index')" :active="route().current('billboard.index')">
                  Billboard
                </NavLink>
                <NavLink :href="route('events.list')" :active="route().current('events.list')">
                  Events
                </NavLink>
                <NavLink :href="route('businesses.index')" :active="route().current('businesses.index')">
                  Businesses
                </NavLink>
                <a href="https://emcagliari.com/short/pVJp4" target="_blank"
                  class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700">
                  Feedback
                </a>
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
              <div class="relative ms-3">
                <!-- Teams Dropdown -->
                <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button type="button"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700">
                        {{ $page.props.auth.user.current_team.name }}

                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <div class="w-60">
                      <!-- Team Management -->
                      <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Team
                      </div>

                      <!-- Team Settings -->
                      <DropdownLink :href="route(
                        'teams.show',
                        $page.props.auth.user.current_team
                      )
                        ">
                        Team Settings
                      </DropdownLink>

                      <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                        Create New Team
                      </DropdownLink>

                      <!-- Team Switcher -->
                      <template v-if="$page.props.auth.user.all_teams.length > 1">
                        <div class="border-t border-gray-200 dark:border-gray-600" />

                        <div class="block px-4 py-2 text-xs text-gray-400">
                          Switch Teams
                        </div>

                        <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                          <form @submit.prevent="switchToTeam(team)">
                            <DropdownLink as="button">
                              <div class="flex items-center">
                                <svg v-if="
                                  team.id ==
                                  $page.props.auth.user.current_team_id
                                " class="w-5 h-5 text-green-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <div>{{ team.name }}</div>
                              </div>
                            </DropdownLink>
                          </form>
                        </template>
                      </template>
                    </div>
                  </template>
                </Dropdown>
              </div>

              <!-- Settings Dropdown -->
              <div class="relative ms-3">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                      class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                      <img class="object-cover w-8 h-8 rounded-full" :src="$page.props.auth.user.profile_photo_url"
                        :alt="$page.props.auth.user.name" />
                    </button>

                    <span v-else class="inline-flex rounded-md">
                      <button type="button"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700">
                        {{ $page.props.auth.user.name }}

                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      Manage Account
                    </div>

                    <DropdownLink :href="route('profile.show')">
                      Profile
                    </DropdownLink>

                    <a target="_blank" v-if="$page.props.auth.user.is_admin === true"
                      :href="route('filament.admin.pages.dashboard')"
                      class="block px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800">
                      Admin area
                    </a>

                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                      API Tokens
                    </DropdownLink>

                    <div class="border-t border-gray-200 dark:border-gray-600" />

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <DropdownLink as="button"> Log Out </DropdownLink>
                    </form>
                  </template>
                </Dropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
              <button
                class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400"
                @click="showingNavigationDropdown = !showingNavigationDropdown">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path :class="{
                    hidden: showingNavigationDropdown,
                    'inline-flex': !showingNavigationDropdown,
                  }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  <path :class="{
                    hidden: !showingNavigationDropdown,
                    'inline-flex': showingNavigationDropdown,
                  }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{
          block: showingNavigationDropdown,
          hidden: !showingNavigationDropdown,
        }" class="sm:hidden">
          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
              Dashboard
            </ResponsiveNavLink>
            <!-- Add Responsive Billboard Link -->
            <ResponsiveNavLink :href="route('billboard.index')" :active="route().current('billboard.index')">
              Billboard
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('events.list')" :active="route().current('events.list')">
              Events
            </ResponsiveNavLink>
            <ResponsiveNavLink :href="route('businesses.index')" :active="route().current('businesses.index')">
              Businesses
            </ResponsiveNavLink>
            <a href="https://emcagliari.com/short/pVJp4" target="_blank"
              class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700">
              Feedback
            </a>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4">
              <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                <img class="object-cover w-10 h-10 rounded-full" :src="$page.props.auth.user.profile_photo_url"
                  :alt="$page.props.auth.user.name" />
              </div>

              <div>
                <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                  {{ $page.props.auth.user.name }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                Profile
              </ResponsiveNavLink>

              <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')"
                :active="route().current('api-tokens.index')">
                API Tokens
              </ResponsiveNavLink>

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <ResponsiveNavLink as="button"> Log Out </ResponsiveNavLink>
              </form>

              <!-- Team Management -->
              <template v-if="$page.props.jetstream.hasTeamFeatures">
                <div class="border-t border-gray-200 dark:border-gray-600" />

                <div class="block px-4 py-2 text-xs text-gray-400">
                  Manage Team
                </div>

                <!-- Team Settings -->
                <ResponsiveNavLink :href="route('teams.show', $page.props.auth.user.current_team)
                  " :active="route().current('teams.show')">
                  Team Settings
                </ResponsiveNavLink>

                <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')"
                  :active="route().current('teams.create')">
                  Create New Team
                </ResponsiveNavLink>

                <!-- Team Switcher -->
                <template v-if="$page.props.auth.user.all_teams.length > 1">
                  <div class="border-t border-gray-200 dark:border-gray-600" />

                  <div class="block px-4 py-2 text-xs text-gray-400">
                    Switch Teams
                  </div>

                  <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                    <form @submit.prevent="switchToTeam(team)">
                      <ResponsiveNavLink as="button">
                        <div class="flex items-center">
                          <svg v-if="
                            team.id == $page.props.auth.user.current_team_id
                          " class="w-5 h-5 text-green-400 me-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          <div>{{ team.name }}</div>
                        </div>
                      </ResponsiveNavLink>
                    </form>
                  </template>
                </template>
              </template>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow dark:bg-gray-800">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
      <Footer />
    </div>
  </div>
</template>
