<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import Form from "@/Components/ui/Form.vue";
import Container from "@/Components/ui/Container.vue";
import { provide } from "vue";
const props = defineProps({
    application: {
        type: Object,
        required: true,
    },
    statuses: Array,
    job_types: Array,
    mode: String,
});
const form = useForm({});
const deleteApplication = (slug) => {
    form.delete(route("application.destroy", slug));
};

provide("application", props.application);
provide("statuses", props.statuses);
provide("job_types", props.job_types);
provide("mode", props.mode);
</script>

<template>
    <Head title="Show" />
    <AuthenticatedLayout>
        <Container>
            <Form is_edit="true" />
            <!-- <form
                @submit.prevent="deleteApplication(props.application.slug)"
            ></form> -->
        </Container>
    </AuthenticatedLayout>
</template>
