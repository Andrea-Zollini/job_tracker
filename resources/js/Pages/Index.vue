<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, Link } from "@inertiajs/vue3";
import { ref, provide, computed, onMounted } from "vue";
import JobApplication from "@/Components/JobApplication.vue";
import { ArrowRightIcon, ArrowLeftIcon } from "@heroicons/vue/20/solid";

const props = defineProps({
    applications: Object,
    message: String,
});

const page = usePage();
const message = computed(() => page.props.flash.message);
provide("message", message);

const showMessage = ref(true);

setTimeout(() => {
    showMessage.value = false;
}, 1500);

// onMounted(() => {
//     console.log(props.applications);
// });
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="px-4 sm:px-6 lg:px-8">
            <template v-if="message && showMessage">
                <div class="flex justify-center">
                    <p
                        class="p-4 text-center text-green-500 transition-all duration-300 ease-linear rounded-md max-w-fit bg-green-50"
                        :class="{ 'opacity-0': !showMessage }"
                    >
                        {{ message }}
                    </p>
                </div>
            </template>
            <template v-if="props.applications.data.length">
                <ul role="list" class="divide-y divide-gray-100">
                    <li
                        v-for="application in props.applications.data"
                        :key="application.id"
                        class="flex items-center justify-between py-5 gap-x-6"
                    >
                        <JobApplication :application="application" />
                    </li>
                </ul>
            </template>
            <template v-else>
                <p class="pt-6 text-center">No applications found.</p>
            </template>
        </div>
        <div
            v-show="
                props.applications.first_page_url !==
                props.applications.last_page_url
            "
            class="sticky bottom-0 flex justify-center"
        >
            <div class="flex items-center justify-center gap-x-9">
                <Link
                    :href="props.applications.prev_page_url || '#'"
                    :as="props.applications.prev_page_url ? 'a' : 'button'"
                    class="flex items-center justify-center gap-x-2 disabled:opacity-50 disabled:pointer-events-none"
                    :disabled="!props.applications.prev_page_url"
                >
                    <ArrowLeftIcon class="w-6 h-6" />
                </Link>
                <span>{{ props.applications.current_page }}</span>
                <Link
                    :href="props.applications.next_page_url || '#'"
                    :as="props.applications.next_page_url ? 'a' : 'button'"
                    class="flex items-center justify-center gap-x-2 disabled:opacity-50 disabled:pointer-events-none"
                    :disabled="!props.applications.next_page_url"
                >
                    <ArrowRightIcon class="w-6 h-6" />
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
