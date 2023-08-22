<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();
const data = page.props.data;

const form = useForm({
  brand_name: data.brand_name,
  company_name: data.company_name,
  logo: null, // File object
  _method: 'patch'
});

const handleSubmit = () => {
  form.post(route('admin.updateBrand', data.id), {
  });
};

const logoPreview = ref('/logo/' + data.logo);

const handleLogoChange = (event) => {
    const file = event.target.files[0];
    form.logo = file;
    if (file) {
        logoPreview.value = URL.createObjectURL(file);
    }
};

</script>

<template>
    <Head title="Edit Brand" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Brand</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-7">

                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Brand</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">The brand data will appear on the customer's page, please fill out the form accordingly.</p>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Brand Name</label>
                                        <div class="mt-2">
                                            <input type="text" v-model="form.brand_name" id="name" required
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Company Name</label>
                                        <div class="mt-2">
                                            <input type="text" v-model="form.company_name" id="name" required
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                </div>

                                <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                    <div class="col-span-3 mt-5">
                                        <label for="thumbnail"
                                            class="block text-sm font-medium leading-6 text-gray-900">Logo</label>
                                        <div class="flex items-center justify-center w-full mt-2">
                                            <label for="dropzone-file"
                                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click
                                                            to upload</span> or drag and drop</p>
                                                    <p class="text-xs text-gray-500">SVG, PNG, JPG (SIZE 1:1)
                                                    </p>
                                                </div>
                                                <input id="dropzone-file" type="file" class="hidden" required
                                                    v-on:change="handleLogoChange" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="sm:col-span-3 mt-5 flex items-center justify-center">
                                        <img class="rounded-lg" style="height: 200px;" :src="logoPreview" alt="Logo">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <Link :href="route('admin.brand')"
                                class="text-sm font-semibold leading-6 text-gray-900">Cancel</Link>
                            <button @click="handleSubmit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
