<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { computed, ref, provide } from "vue";
import Container from "@/Components/ui/Container.vue";
import JobApplication from "@/Components/JobApplication.vue";

const props = defineProps({
    applications: Array,
    message: String,
});

const page = usePage();
const message = computed(() => page.props.flash.message);
provide("message", message);

const showMessage = ref(true);

setTimeout(() => {
    showMessage.value = false;
}, 1500);
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <Container>
            <template v-if="message && showMessage">
                <div class="flex justify-center">
                    <p
                        class="p-4 pt-6 text-center text-green-500 transition-all duration-300 ease-linear rounded-md max-w-fit bg-green-50"
                        :class="{ 'opacity-0': !showMessage }"
                    >
                        {{ message }}
                    </p>
                </div>
            </template>
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
