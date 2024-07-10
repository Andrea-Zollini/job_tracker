<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
const props = defineProps({
    application: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AuthenticatedLayout>
        <div>
            <h1>{{ props.application.job_title }}</h1>
            <p>{{ props.application.description }}</p>
        </div>
    </AuthenticatedLayout>
</template>
