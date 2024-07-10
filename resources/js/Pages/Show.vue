<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
const props = defineProps({
    application: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Show" />
    <AuthenticatedLayout>
        <div>
            <h1>{{ props.application.job_title }}</h1>
            <p>{{ props.application.description }}</p>
        </div>
    </AuthenticatedLayout>
</template>
