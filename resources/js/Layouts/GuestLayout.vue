<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0"
    >
        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-gray-200 shadow-md sm:max-w-md sm:rounded-lg dark:bg-slate-800"
        >
            <div class="flex flex-col items-center justify-center">
                <h1 class="order-1 my-3 uppercase">Job Journal</h1>
                <Link href="/">
                    <ApplicationLogo class="w-20 h-20 fill-current" />
                </Link>
            </div>
            <slot />
        </div>
    </div>
</template>
