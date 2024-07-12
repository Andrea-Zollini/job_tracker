<script setup>
import { useForm } from "@inertiajs/vue3";
import { inject, ref, onMounted } from "vue";

const statuses = inject("statuses");
const job_types = inject("job_types");
const mode = inject("mode");
const application = inject("application", null);
const addedTechnology = ref("");
const metadata = application
    ? ref(JSON.parse(application.metadata))
    : ref(null);

const form = useForm({
    job_title: "",
    description: "",
    company_name: "",
    location: "",
    status: "",
    job_type: "",
    metadata: {
        technologies: [],
    },
});

const prettyString = (str) => {
    if (str.includes("_") || str.includes("-")) {
        return str.split("_").join(" ").split("-").join(" ");
    }
    return str;
};

const sanitize = (str) => {
    let sanitized = str.toLowerCase();
    sanitized = sanitized.charAt(0).toUpperCase() + sanitized.slice(1);
    return sanitized.trim();
};

const addTechnology = (e) => {
    e.preventDefault();
    switch (mode) {
        case "edit":
            if (addedTechnology.value.trim() !== "") {
                metadata.value.technologies.push(
                    sanitize(addedTechnology.value)
                );
                addedTechnology.value = "";
            }
            form.metadata = JSON.stringify(metadata.value);
            application.metadata = JSON.stringify(metadata.value);
            break;
        default:
            if (addedTechnology.value.trim() !== "") {
                form.metadata.technologies.push(
                    sanitize(addedTechnology.value)
                );
                addedTechnology.value = "";
            }
            break;
    }
};

const removeTechnology = (index) => {
    switch (mode) {
        case "edit":
            metadata.value.technologies.splice(index, 1);
            form.metadata = JSON.stringify(metadata.value);
            application.metadata = JSON.stringify(metadata.value);
            break;
        default:
            form.metadata.technologies.splice(index, 1);
            break;
    }
};

const submit = (e) => {
    e.preventDefault();
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
        // console.log(application.metadata);
        application.value = inject("application");
        form.job_title = application.job_title;
        form.description = application.description;
        form.company_name = application.company_name;
        form.location = application.location;
        form.status = application.status;
        form.job_type = application.job_type;
        form.metadata = application.metadata;
    }
});
</script>

<template>
    <form @submit.prevent="submit" class="mt-12">
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

                <div class="flex flex-col mt-6 lg:flex-row">
                    <div class="lg:pe-3 sm:col-span-4">
                        <label
                            for="company_name"
                            class="block text-sm font-medium leading-6"
                            >Technologies*</label
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
                                    v-model="addedTechnology"
                                    style="text-indent: 0.5rem"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="Insert Technologies"
                                />
                            </div>
                            <button
                                class="px-3 py-2 mt-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                @click="addTechnology"
                            >
                                Add
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <template
                            v-for="(technology, index) in form.metadata
                                .technologies"
                        >
                            <span
                                class="inline-flex items-center px-3 py-2 mx-2 mb-3 text-xs font-medium text-gray-600 bg-gray-100 rounded-full"
                            >
                                {{ technology }}
                                <button
                                    type="button"
                                    @click="removeTechnology(index)"
                                    class="ms-2"
                                >
                                    X
                                </button>
                            </span>
                        </template>
                        <template
                            v-if="
                                application &&
                                JSON.parse(application.metadata).technologies
                                    .length
                            "
                        >
                            <template
                                v-for="(technology, index) in JSON.parse(
                                    application.metadata
                                ).technologies"
                            >
                                <span
                                    class="inline-flex items-center px-3 py-2 mx-2 mb-3 text-xs font-medium text-gray-600 bg-gray-100 rounded-full"
                                >
                                    {{ technology }}
                                    <button
                                        type="button"
                                        @click="removeTechnology(index)"
                                        class="ms-2"
                                    >
                                        X
                                    </button>
                                </span>
                            </template>
                        </template>
                    </div>
                </div>
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
