<script setup>
import AppLayout from "@/Layouts/GuestLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
  title: String,
  canLogin: Boolean,
  canRegister: Boolean,
  business: Object,
  locale: {
    type: String,
    default: "en",
  },
});
</script>

<template>
  <AppLayout :title="title" :can-register="canRegister" :can-login="canLogin">
    <section class="py-12 bg-white dark:bg-gray-900">
      <div class="container px-4 mx-auto">
        <div class="max-w-6xl mx-auto">
          <div class="flex flex-col md:flex-row md:space-x-8">
            <div class="space-y-8 md:w-2/3">
              <h2
                class="text-3xl font-semibold text-gray-800 dark:text-white md:text-4xl"
              >
                {{ business.name }}
              </h2>
              <div class="space-y-4">
                <div
                  class="prose dark:prose-invert max-w-none"
                  v-html="business.description"
                ></div>
                <!-- <div v-if="business.tags?.length > 0" class="flex flex-wrap gap-2 mb-4">
                                    <span v-for="tag in business.tags" :key="tag.id"
                                          class="inline-block px-3 py-1 text-sm bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-white">
                                        {{ tag.name[locale] }}
                                    </span>
                                </div> -->
                <div class="flex justify-start gap-x-4">
                  <p
                    class="pt-3 text-sm text-left text-gray-800 dark:text-white"
                    v-if="business.telephone"
                  >
                    <a :href="'tel:' + business.telephone">
                      <v-icon
                        name="fa-phone-alt"
                        class="w-4 h-4 mr-2"
                        animation="wrench"
                        hover
                      />
                      {{ business.telephone }}
                    </a>
                  </p>

                  <p
                    class="pt-3 text-sm text-left text-gray-800 dark:text-white"
                    v-if="business.email"
                  >
                    <a :href="'mailto:' + business.email">
                      <div aria-label="Email">
                        <v-icon
                          name="fa-mail-bulk"
                          class="w-4 h-4 mr-2"
                          animation="wrench"
                          hover
                        />
                        {{ business.email }}
                      </div>
                    </a>
                  </p>
                </div>
                <div class="flex pt-4 border-t">
                  <a :href="business.url"  v-if="business.url">
                    <div aria-label="Site">
                      <v-icon
                        name="fa-link"
                        class="w-4 h-4"
                        animation="wrench"
                        hover
                      />
                    </div>
                  </a>

                  <a
                    :href="business.linkedin_url"
                    class="mx-5"
                    v-if="business.linkedin_url"
                  >
                    <div aria-label="Linkedin">
                      <v-icon
                        name="fa-linkedin"
                        class="w-4 h-4"
                        animation="wrench"
                        hover
                      />
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <div class="mt-8 md:w-1/3 md:mt-0">
              <div class="sticky top-8">
                <div class="overflow-hidden rounded-lg shadow-lg">
                  <img
                    :src="business.photo_url"
                    :alt="business.title"
                    class="object-cover w-full h-auto"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
