<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { ref, provide, computed } from "vue";
import JobApplication from "@/Components/JobApplication.vue";
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
        <div class="sticky bottom-0 flex justify-center">
            Pagination goes here
        </div>
    </AuthenticatedLayout>
</template>
