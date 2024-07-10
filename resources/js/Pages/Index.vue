<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { onMounted } from "vue";
import Container from "@/Components/ui/Container.vue";
import JobApplication from "@/Components/JobApplication.vue";

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
        <Container>
            <template v-for="application in applications" :key="application.id">
                <JobApplication :application="application" />
            </template>
        </Container>
    </AuthenticatedLayout>
</template>
