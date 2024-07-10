<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    applications: {
        type: Array,
        required: true,
    },
});

onMounted(() => {
    console.log(props.applications);
});
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <template v-for="application in applications" :key="application.id">
            <Link
                :href="`/applications/application-${application.slug}`"
                class="p-4 border border-gray-200 rounded-lg"
            >
                {{ application.job_title }}
            </Link>
        </template>
    </AuthenticatedLayout>
</template>
