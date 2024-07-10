<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Container from "@/Components/ui/Container.vue";
import JobApplication from "@/Components/JobApplication.vue";

const props = defineProps({
    applications: Array,
});
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <Container>
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
        </Container>
    </AuthenticatedLayout>
</template>
