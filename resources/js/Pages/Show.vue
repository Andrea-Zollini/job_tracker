<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
const props = defineProps({
    application: {
        type: Object,
        required: true,
    },
});
const form = useForm({});
const deleteApplication = (slug) => {
    form.delete(route("application.destroy", slug));
};
</script>

<template>
    <Head title="Show" />
    <AuthenticatedLayout>
        <div>
            <h1>{{ props.application.job_title }}</h1>
            <p>{{ props.application.description }}</p>
            <form @submit.prevent="deleteApplication(props.application.slug)">
                <DangerButton class="px-4 py-2 bg-red-500 rounded" type="submit"
                    >Elimina
                </DangerButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
