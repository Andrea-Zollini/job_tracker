<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Container from "@/Components/ui/Container.vue";
import { ArrowLeftCircleIcon } from "@heroicons/vue/24/outline";
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
        <Container>
            <!-- <Link :href="route('dashboard')" class="flex items-center gap-x-2">
                <ArrowLeftCircleIcon
                    class="w-6 h-6 shrink-0"
                    aria-hidden="true"
                />
                Go Back
            </Link> -->
            <h1 class="mt-8 text-3xl font-bold text-center">
                Add a new Job Application
            </h1>
            <Form is_edit="false" />
        </Container>
    </AuthenticatedLayout>
</template>
