<script setup>
import { useForm } from "@inertiajs/vue3";
import { inject, ref, onMounted, watch } from "vue";
import DangerButton from "@/Components/DangerButton.vue";

const statuses = inject("statuses");
const job_types = inject("job_types");
const mode = inject("mode");
const application = inject("application", null);

const form = useForm({
    job_title: "",
    description: "",
    company_name: "",
    location: "",
    status: "",
    job_type: "",
});

const prettyString = (str) => {
    if (str.includes("_") || str.includes("-")) {
        return str.split("_").join(" ").split("-").join(" ");
    }
    return str;
};

const submit = (e) => {
    switch (mode) {
        case "edit":
            form.put(route("application.update", application.slug));
            break;

        default:
            "create";
            form.post(route("application.store"));
            break;
    }
};

onMounted(() => {
    if (mode === "edit" && application) {
        form.job_title = application.job_title;
        form.description = application.description;
        form.company_name = application.company_name;
        form.location = application.location;
        form.status = application.status;
        form.job_type = application.job_type;
    }
});
</script>

<template>
    <form @submit.prevent="submit">
        <div class="space-y-12">
            <div class="pb-12 border-b border-gray-900/10">
                <div
                    class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6"
                >
                    <div class="sm:col-span-4">
                        <label
                            for="title"
                            class="block text-sm font-medium leading-6"
                            >Title*</label
                        >
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                            >
                                <input
                                    type="text"
                                    name="job_title"
                                    id="job_title"
                                    autocomplete="job_title"
                                    v-model="form.job_title"
                                    required
                                    style="text-indent: 0.5rem"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="Insert Job Title"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label
                            for="description"
                            class="block text-sm font-medium leading-6"
                            >Description</label
                        >
                        <div class="mt-2">
                            <textarea
                                id="about"
                                name="about"
                                rows="3"
                                v-model="form.description"
                                class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-transparent"
                            />
                        </div>
                    </div>

                    <div
                        class="flex flex-col justify-between col-span-full lg:flex-row"
                    >
                        <div class="flex-1 lg:pe-3 sm:col-span-4">
                            <label
                                for="company_name"
                                class="block text-sm font-medium leading-6"
                                >Company Name*</label
                            >
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                                >
                                    <input
                                        type="text"
                                        name="company_name"
                                        id="company_name"
                                        autocomplete="company_name"
                                        v-model="form.company_name"
                                        required
                                        style="text-indent: 0.5rem"
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Insert Company Name"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 lg:px-3 sm:col-span-4">
                            <label
                                for="location"
                                class="block mt-6 text-sm font-medium leading-6 lg:mt-0"
                            >
                                Location*</label
                            >
                            <div class="mt-2">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md"
                                >
                                    <input
                                        type="text"
                                        name="location"
                                        id="location"
                                        autocomplete="location"
                                        v-model="form.location"
                                        required
                                        style="text-indent: 0.5rem"
                                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Insert Location"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Status Select -->
                        <div class="flex-1 lg:px-3">
                            <label
                                for="status"
                                class="block mt-6 text-sm font-medium leading-6 lg:mt-0"
                                >Status*</label
                            >
                            <select
                                id="status"
                                name="status"
                                v-model="form.status"
                                class="mt-2 block w-full bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-50 rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            >
                                <option
                                    v-for="(status, index) in statuses"
                                    :key="index"
                                >
                                    {{ prettyString(status) }}
                                </option>
                            </select>
                        </div>

                        <!-- Job Type Select -->
                        <div class="flex-1 lg:ps-3">
                            <label
                                for="job_type"
                                class="block mt-6 text-sm font-medium leading-6 lg:mt-0"
                                >Job Type*</label
                            >
                            <select
                                id="job_type"
                                name="job_type"
                                v-model="form.job_type"
                                required
                                class="mt-2 block w-full bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-50 rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            >
                                <option
                                    v-for="(job_type, index) in job_types"
                                    :key="index"
                                >
                                    {{ prettyString(job_type) }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col mt-6 lg:flex-row"></div>
            </div>
        </div>

        <div class="flex items-center justify-end mt-6 gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6">
                Cancel
            </button>
            <button
                type="submit"
                class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                Save
            </button>
        </div>
    </form>
</template>
