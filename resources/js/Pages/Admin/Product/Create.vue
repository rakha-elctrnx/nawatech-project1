<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const data = usePage().props.data;
console.log(data);

const form = useForm({
  brand_id: '',
  product_name: ''
});

const handleSubmit = () => {
  form.post(route('admin.storeProduct'), {
  });
};

</script>

<template>
    <Head title="Add Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-7">

                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Add Product</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">The added product data will appear on the customer's page, please fill out the form accordingly.</p>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Brand</label>
                                            <select id="countries" v-model="form.brand_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 mt-2">
                                            <option selected value="">Choose a brand</option>
                                                <option v-for="item in data" :value="item.id">{{ item.brand_name }}</option>
                                            </select>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
                                        <div class="mt-2">
                                            <input type="text" v-model="form.product_name" id="name" required
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
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
