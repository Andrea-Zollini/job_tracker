<script setup>
import { ref, computed } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head, Link } from "@inertiajs/vue3";
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    Bars3Icon,
    BellIcon,
    Cog6ToothIcon,
    HomeIcon,
    XMarkIcon,
    ArrowLeftCircleIcon,
    UserIcon,
    PlusCircleIcon,
} from "@heroicons/vue/24/outline";
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const currentRoute = computed(() => route().current());

const navigation = ref([
    {
        name: "Dashboard",
        href: "dashboard",
        icon: HomeIcon,
        current: currentRoute.value === "dashboard",
    },
    {
        name: "Add",
        href: "application.create",
        icon: PlusCircleIcon,
        current: currentRoute.value === "application.create",
    },
]);

const setActive = (clicked) => {
    navigation.value.forEach((item) => {
        item.current = item.href === clicked.href;
    });
};

const sidebarOpen = ref(false);
</script>

<template>
    <Head title="Dashboard" />
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                class="relative z-50 lg:hidden"
                @close="sidebarOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild
                        as="template"
                        enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full"
                        enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leave-from="translate-x-0"
                        leave-to="-translate-x-full"
                    >
                        <DialogPanel
                            class="relative flex flex-1 w-full max-w-xs mr-16"
                        >
                            <TransitionChild
                                as="template"
                                enter="ease-in-out duration-300"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="ease-in-out duration-300"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <div
                                    class="absolute top-0 flex justify-center w-16 pt-5 left-full"
                                >
                                    <button
                                        type="button"
                                        class="-m-2.5 p-2.5"
                                        @click="sidebarOpen = false"
                                    >
                                        <span class="sr-only"
                                            >Close sidebar</span
                                        >
                                        <XMarkIcon
                                            class="w-6 h-6 text-white"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </TransitionChild>
                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <div
                                class="flex flex-col px-6 pb-4 overflow-y-auto bg-slate-600 grow gap-y-5"
                            >
                                <Link
                                    :href="route('dashboard')"
                                    class="flex items-center h-16 shrink-0"
                                >
                                    <ApplicationLogo class="w-auto h-8" />
                                </Link>
                                <nav class="flex flex-col flex-1">
                                    <ul
                                        role="list"
                                        class="flex flex-col flex-1 gap-y-7"
                                    >
                                        <li>
                                            <ul
                                                role="list"
                                                class="-mx-2 space-y-1"
                                            >
                                                <li
                                                    v-for="item in navigation"
                                                    :key="item.name"
                                                >
                                                    <NavLink
                                                        :href="route(item.href)"
                                                        :class="[
                                                            item.current
                                                                ? 'bg-slate-700 text-white'
                                                                : 'text-indigo-200 hover:bg-slate-700 hover:text-white',
                                                            'group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6',
                                                        ]"
                                                    >
                                                        <component
                                                            :is="item.icon"
                                                            :class="[
                                                                item.current
                                                                    ? 'text-white'
                                                                    : 'text-indigo-200 group-hover:text-white',
                                                                'h-6 w-6 shrink-0',
                                                            ]"
                                                            aria-hidden="true"
                                                        />
                                                        {{ item.name }}
                                                    </NavLink>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mt-auto">
                                            <a
                                                :href="route('profile.edit')"
                                                class="flex p-2 -mx-2 text-sm font-semibold leading-6 text-indigo-200 rounded-md group gap-x-3 hover:bg-slate-700 hover:text-white"
                                            >
                                                <Cog6ToothIcon
                                                    class="w-6 h-6 text-indigo-200 shrink-0 group-hover:text-white"
                                                    aria-hidden="true"
                                                />
                                                Settings
                                            </a>
                                            <Link
                                                :href="route('profile.edit')"
                                                class="flex p-2 -mx-2 text-sm font-semibold leading-6 text-indigo-200 rounded-md group gap-x-3 hover:bg-slate-700 hover:text-white"
                                            >
                                                <UserIcon
                                                    class="w-6 h-6 text-indigo-200 shrink-0 group-hover:text-white"
                                                    aria-hidden="true"
                                                />
                                                Profile
                                            </Link>
                                            <Link
                                                :href="route('logout')"
                                                class="flex p-2 -mx-2 text-sm font-semibold leading-6 text-indigo-200 rounded-md group gap-x-3 hover:bg-slate-700 hover:text-white"
                                            >
                                                <ArrowLeftCircleIcon
                                                    class="w-6 h-6 text-indigo-200 shrink-0 group-hover:text-white"
                                                    aria-hidden="true"
                                                />
                                                Log out
                                            </Link>
                                        </li>
                                        <li></li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div
            class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
        >
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div
                class="flex flex-col px-6 pb-4 overflow-y-auto bg-slate-600 grow gap-y-5"
            >
                <Link
                    :href="route('dashboard')"
                    class="flex items-center h-16 shrink-0"
                >
                    <ApplicationLogo class="w-auto h-8" />
                </Link>
                <nav class="flex flex-col flex-1">
                    <ul role="list" class="flex flex-col flex-1 gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <Link
                                        :href="route(item.href)"
                                        @click="setActive(item)"
                                        :class="[
                                            item.current
                                                ? 'bg-slate-700 text-white'
                                                : 'text-indigo-200 hover:bg-slate-700 hover:text-white',
                                            'group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6',
                                        ]"
                                    >
                                        <component
                                            :is="item.icon"
                                            :class="[
                                                item.current
                                                    ? 'text-white'
                                                    : 'text-indigo-200 group-hover:text-white',
                                                'h-6 w-6 shrink-0',
                                            ]"
                                            aria-hidden="true"
                                        />
                                        {{ item.name }}
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li class="mt-auto">
                            <a
                                href="#"
                                class="flex p-2 -mx-2 text-sm font-semibold leading-6 text-indigo-200 rounded-md group gap-x-3 hover:bg-slate-700 hover:text-white"
                            >
                                <Cog6ToothIcon
                                    class="w-6 h-6 text-indigo-200 shrink-0 group-hover:text-white"
                                    aria-hidden="true"
                                />
                                Settings
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div
                class="sticky top-0 z-40 flex items-center h-16 px-4 shrink-0 gap-x-4 sm:gap-x-6 sm:px-6 lg:px-8"
            >
                <button
                    type="button"
                    class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <Bars3Icon class="w-6 h-6" aria-hidden="true" />
                </button>

                <!-- Separator -->
                <div
                    class="w-px h-6 bg-gray-900/10 lg:hidden"
                    aria-hidden="true"
                />

                <div
                    v-show="navigation[0].current"
                    class="flex self-stretch flex-1 gap-x-4 lg:gap-x-6"
                >
                    <form class="relative flex flex-1" action="#" method="GET">
                        <label for="search-field" class="sr-only">Search</label>
                        <MagnifyingGlassIcon
                            class="absolute inset-y-0 left-0 w-5 h-full text-gray-400 pointer-events-none"
                            aria-hidden="true"
                        />
                        <input
                            id="search-field"
                            class="block w-full h-full py-0 pl-8 pr-0 bg-transparent border-0 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                            placeholder="Search..."
                            type="search"
                            name="search"
                        />
                    </form>
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <!-- Separator -->
                        <div
                            class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-900/10"
                            aria-hidden="true"
                        />

                        <!-- Profile dropdown -->

                        <div class="relative hidden ms-3 lg:block">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out border border-transparent rounded-md hover:text-gray-700 focus:outline-none"
                                        >
                                            {{ $page.props.auth.user.name }}

                                            <svg
                                                class="ms-2 -me-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </div>

            <main class="py-10">
                <slot />
            </main>
        </div>
    </div>
</template>
