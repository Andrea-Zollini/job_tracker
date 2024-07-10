<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import Container from "@/Components/ui/Container.vue";

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
                <div class="py-8">
                    <Link
                        :href="`/applications/application-${application.slug}`"
                        class="p-4 border border-gray-200 rounded-lg"
                    >
                        {{ application.job_title }}
                    </Link>
                </div>
            </template>
        </Container>
    </AuthenticatedLayout>
</template>
