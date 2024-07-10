<script setup>
import { ref } from "vue";
import { Dialog, DialogPanel } from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import Container from "@/Components/ui/Container.vue";

const navigation = [
    { name: "Dashboard", href: "dashboard" },
    { name: "Add", href: "application.create" },
];

const mobileMenuOpen = ref(false);
</script>

<template>
    <Container>
        <header>
            <nav
                class="flex items-center justify-between py-6 gap-x-6"
                aria-label="Global"
            >
                <div class="flex items-center shrink-0">
                    <div class="flex items-center shrink-0">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block w-auto fill-current h-9"
                            />
                        </Link>
                    </div>
                    <div class="hidden ms-6 lg:flex lg:gap-x-2">
                        <NavLink
                            v-for="item in navigation"
                            :key="item.name"
                            :href="route(item.href)"
                            class="text-sm font-semibold leading-6"
                        >
                            {{ item.name }}
                        </NavLink>
                    </div>
                </div>
                <template v-if="!$page.props.auth.user">
                    <div class="flex items-center justify-end flex-1 gap-x-6">
                        <a
                            href="#"
                            class="hidden lg:block lg:text-sm lg:font-semibold lg:leading-6"
                            >Log in</a
                        >
                        <a
                            href="#"
                            class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            >Sign up</a
                        >
                    </div>
                </template>
                <template v-else>
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
                </template>
                <div class="flex lg:hidden">
                    <button
                        type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true"
                    >
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="w-6 h-6" aria-hidden="true" />
                    </button>
                </div>
            </nav>
            <Dialog
                class="lg:hidden"
                @close="mobileMenuOpen = false"
                :open="mobileMenuOpen"
            >
                <div class="fixed inset-0 z-10" />
                <DialogPanel
                    class="fixed inset-y-0 right-0 z-10 w-full px-4 py-6 overflow-y-auto sm:px-6 bg-slate-50 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                >
                    <div class="flex items-center gap-x-6">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block w-auto fill-current h-9"
                            />
                        </Link>
                        <Link
                            v-if="!$page.props.auth.user"
                            :href="route('register')"
                            class="px-3 py-2 ml-auto text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Sign up
                        </Link>
                        <button
                            type="button"
                            class="-m-2.5 ms-auto rounded-md p-2.5 text-gray-700"
                            @click="mobileMenuOpen = false"
                        >
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="w-6 h-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="flow-root mt-6">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="flex flex-col py-6">
                                <Link
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="route(item.href)"
                                    class="block px-3 py-2 -mx-3 text-base font-semibold leading-7 text-gray-900 rounded-lg"
                                >
                                    {{ item.name }}
                                </Link>
                            </div>
                            <div class="py-6">
                                <template v-if="!$page.props.auth.user">
                                    <Link
                                        href="#"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                    >
                                        Log in
                                    </Link>
                                </template>
                                <template v-else>
                                    <Link
                                        :href="route('profile.edit')"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                    >
                                        Profile
                                    </Link>
                                    <Link
                                        :href="route('logout')"
                                        class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                    >
                                        Log out
                                    </Link>
                                </template>
                            </div>
                        </div>
                    </div>
                </DialogPanel>
            </Dialog>
        </header>
    </Container>
</template>
