<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Form from "@/Components/ui/Form.vue";
import { Head, Link } from "@inertiajs/vue3";
import { provide } from "vue";

const props = defineProps({
    statuses: Array,
    job_types: Array,
    mode: String,
    application: Object,
});

provide("statuses", props.statuses);
provide("job_types", props.job_types);
provide("mode", props.mode);
</script>
<template>
    <Head title="Create" />
    <AuthenticatedLayout>
        <div>
            <h1 class="mt-8 text-3xl font-bold text-center">
                Add a new Job Application
            </h1>
            <Form is_edit="false" />
        </div>
    </AuthenticatedLayout>
</template>
