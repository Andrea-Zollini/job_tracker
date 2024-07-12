<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import { ArrowLeftCircleIcon } from "@heroicons/vue/24/outline";
import Form from "@/Components/ui/Form.vue";
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
        <Link
            :href="route('dashboard')"
            class="absolute flex items-center gap-x-2"
        >
            <ArrowLeftCircleIcon class="w-6 h-6 shrink-0" aria-hidden="true" />
            Go Back
        </Link>
        <Form is_edit="true" />
        <form
            @submit.prevent="deleteApplication(props.application.slug)"
            class="absolute bottom-[3%] lg:bottom-[33%]"
        >
            <DangerButton class="px-4 py-2 bg-red-500 rounded" type="submit">
                Delete
            </DangerButton>
        </form>
    </AuthenticatedLayout>
</template>
