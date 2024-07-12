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
            <template v-if="props.applications.data.length">
                <template
                    v-for="application in props.applications.data"
                    :key="application.id"
                >
                    <JobApplication :application="application" />
                </template>
            </template>
            <template v-else>
                <p class="pt-6 text-center">No applications found.</p>
            </template>
        </div>
    </AuthenticatedLayout>
</template>
