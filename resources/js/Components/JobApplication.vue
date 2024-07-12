<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { EllipsisVerticalIcon } from "@heroicons/vue/20/solid";
import { onMounted } from "vue";

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

const form = useForm({});
const deleteApplication = (slug) => {
    form.delete(route("application.destroy", slug));
};
</script>

<template>
    <div class="min-w-0">
        <div class="flex items-start gap-x-3">
            <p class="text-sm font-semibold leading-6">
                {{ application.job_title }}
            </p>
            <p
                :class="[
                    statusColors[application.status],
                    'mt-0.5 whitespace-nowrap rounded-md px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset',
                ]"
            >
                {{ application.status }}
            </p>
        </div>

        <div
            class="flex items-center mt-1 text-sm leading-5 text-gray-500 gap-x-2"
        >
            <template
                v-for="technology in JSON.parse(application.metadata)
                    .technologies"
            >
                <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                    <circle cx="1" cy="1" r="1" />
                </svg>
                <p class="truncate">{{ technology }}</p>
            </template>
        </div>
    </div>
    <div class="flex items-center flex-none gap-x-4">
        <Link
            :href="`/applications/application-${application.slug}`"
            class="hidden rounded-md px-2.5 py-1.5 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 sm:block"
        >
            View application
            <span class="sr-only">
                {{ application.job_title }}
            </span>
        </Link>
        <Menu as="div" class="relative flex-none">
            <MenuButton class="-m-2.5 block p-2.5 text-gray-200 hover:">
                <span class="sr-only">Open options</span>
                <EllipsisVerticalIcon class="w-5 h-5" aria-hidden="true" />
            </MenuButton>
            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute right-0 z-10 flex flex-col justify-center w-32 py-2 mt-2 origin-top-right bg-white rounded-md shadow-lg dark:bg-gray-800 ring-1 ring-gray-900/5 focus:outline-none"
                >
                    <MenuItem v-slot="{ active }">
                        <Link
                            :href="`/applications/application-${application.slug}`"
                            :class="[
                                active ? 'bg-gray-50 dark:bg-gray-700' : '',
                                'flex-1 mx-2 rounded sm:hidden mb-1 text-sm leading-6 text-center',
                            ]"
                        >
                            View
                            <span class="sr-only">
                                {{ application.name }}
                            </span>
                        </Link>
                    </MenuItem>
                    <!-- <MenuItem v-slot="{ active }">
                        <a
                            href="#"
                            :class="[
                                active ? 'bg-gray-50' : '',
                                'block px-3 py-1 text-sm leading-6 ',
                            ]"
                            >Move<span class="sr-only"
                                >, {{ application.name }}</span
                            ></a
                        >
                    </MenuItem> -->
                    <MenuItem v-slot="{ active }" class="flex justify-center">
                        <form
                            class="flex items-center w-full gap-x-2"
                            @submit.prevent="
                                deleteApplication(application.slug)
                            "
                        >
                            <button
                                type="submit"
                                :class="[
                                    active ? 'bg-gray-50 dark:bg-gray-700' : '',
                                    'flex-1 mx-2 rounded text-sm leading-6 text-center',
                                ]"
                            >
                                Delete<span class="sr-only"
                                    >, {{ application.name }}</span
                                >
                            </button>
                        </form>
                    </MenuItem>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>
