<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    application: Object,
});

const statusColors = {
    pending: "bg-yellow-100 text-yellow-700",
    approved: "bg-green-100 text-green-700",
    rejected: "bg-red-100 text-red-700",
    cancelled: "bg-gray-100 text-gray-700",
    completed: "bg-blue-100 text-blue-700",
    initial_interview: "bg-fuchsia-100 text-fuchsia-700",
    technical_interview: "bg-purple-100 text-purple-700",
};

const getStatusColor = (status) => {
    return statusColors[status];
};
</script>

<template>
    <div class="py-8">
        <Link
            :href="`/applications/application-${application.slug}`"
            class="flex p-4 border border-gray-200 rounded-lg"
        >
            <p>{{ props.application.job_title }}</p>
            <span
                :class="getStatusColor(props.application.status)"
                class="inline-flex items-center px-4 py-1 text-sm font-bold capitalize rounded-full ms-auto"
            >
                {{ props.application.status }}
            </span>
        </Link>
    </div>
</template>
