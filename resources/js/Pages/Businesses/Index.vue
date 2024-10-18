<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import Search from "@/Pages/Dashboard/Search.vue";

export default defineComponent({
  components: {
    AppLayout,
    Link,
    Pagination,
    Search,
  },
  props: {
    businesses: Object,
    can: Object,
    locale: String,
    search: String,
  },
  data() {
    return {
      form: {
        search: this.search,
      },
    };
  },
  methods: {},
});
</script>

<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Businesses
        </h2>
        <Search :locale="locale" :search="form.search" />
        <Link
          v-if="can.createBusiness"
          :href="route('businesses.create')"
          type="submit"
          class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 border border-transparent rounded-md dark:bg-white dark:text-gray-800 hover:bg-gray-700"
          :disabled="form.processing"
        >
          Add your business
        </Link>
      </div>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6">
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div
              v-for="business in businesses.data"
              :key="business.id"
              class="overflow-hidden bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow-md min-h-[300px]"
            >
              <img
                v-if="business.photo_url"
                :src="business.photo_url"
                :alt="business.name"
                class="object-cover w-full h-48"
              />
              <div class="p-4">
                <h3 class="text-lg font-semibold">
                  <Link :href="route('businesses.edit', business.id)">
                    {{ business.name }}
                  </Link>
                </h3>
                <p class="overflow-y-auto text-gray-600 max-h-20 min-h-20" v-html="business.description"></p>
                <p class="pt-3 text-sm text-left text-gray-800 dark:text-white" v-if="business.telephone">
                  <a :href="'tel:' + business.telephone">
                    <v-icon name="fa-phone-alt" class="w-4 h-4 mr-2" animation="wrench" hover />
                    {{ business.telephone }}
                  </a>
                </p>

                <p class="pt-3 text-sm text-left text-gray-800 dark:text-white" v-if="business.email">
                  <a :href="'mailto:' + business.email">
                    <div aria-label="Email">
                      <v-icon name="fa-mail-bulk" class="w-4 h-4 mr-2" animation="wrench" hover />
                      {{ business.email }}
                    </div>
                  </a>
                </p>
                <p class="text-gray-600" v-if="business.is_sponsor">Sponsor</p>
                <p class="text-gray-600" v-if="business.is_public">Public</p>
                <p class="text-gray-600" v-if="!business.is_approved">Not approved yet.</p>
              </div>
              <div class="flex p-4 border-t">
                <a :href="business.url" class="mx-5" v-if="business.url">
                  <div aria-label="Site">
                    <v-icon name="fa-link" class="w-4 h-4" animation="wrench" hover />
                  </div>
                </a>

                <a :href="business.linkedin_url" class="mx-5" v-if="business.linkedin_url">
                  <div aria-label="Linkedin">
                    <v-icon name="fa-linkedin" class="w-4 h-4" animation="wrench" hover />
                  </div>
                </a>

                <Link
                  v-if="can.updateBusiness[business.id]"
                  :href="route('businesses.edit', business.id)"
                  class="mx-5"
                >
                  <div aria-label="Edit">
                    <v-icon name="fa-pencil-alt" class="w-4 h-4" animation="wrench" hover />
                  </div>
                </Link>
              </div>
            </div>
            <div v-if="businesses.data.length === 0" class="col-span-1">
              <p class="px-6 py-4 text-gray-600">No business found.</p>
            </div>
          </div>
          <pagination :links="businesses.links" />
        </div>
      </div>
    </div>
  </app-layout>
</template>
