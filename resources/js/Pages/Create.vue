<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Container from "@/Components/ui/Container.vue";
import Form from "@/Components/ui/Form.vue";
import { Head } from "@inertiajs/vue3";
import { provide } from "vue";

const props = defineProps({
    statuses: Array,
    job_types: Array,
});

provide("statuses", props.statuses);
provide("job_types", props.job_types);
</script>
<template>
    <Head title="Create" />
    <AuthenticatedLayout>
        <Container>
            <h1 class="mt-8 text-3xl font-bold text-center">
                Add a new Job Application
            </h1>
            <Form statuses="props.statuses" />
        </Container>
    </AuthenticatedLayout>
</template>
