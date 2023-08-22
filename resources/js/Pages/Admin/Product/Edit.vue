<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import TypeCard from './Partials/TypeCard.vue';
import typeForm from './Partials/TypeForm.vue';
import { ref, watch } from 'vue';

let data = usePage().props.data;
const brands = usePage().props.brands;

const productForm = useForm({
    brand_id: data.brand_id,
    product_name: data.product_name,
    _method: 'patch'
});

const handleSubmit = () => {
    productForm.post(route('admin.updateProduct', data.id), {
    });
};

let showTypeForm = ref(false);
let isTypeCardCollapse = ref(0);
const changeCollapseNumber = (params) => {
    isTypeCardCollapse.value = params
}

watch(() => usePage().props.data, (newData) => {
    data = newData;
});
</script>

<template>
    <Head title="Edit Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-7">

                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Edit Product</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">The brand data will appear on the customer's
                                page, please fill out the productForm accordingly.</p>

                            <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="name"
                                        class="block text-sm font-medium leading-6 text-gray-900">Brand</label>
                                    <select id="countries" v-model="productForm.brand_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 mt-2">
                                        <option selected value="">Choose a brand</option>
                                        <option v-for="item in brands" :key="item.id" :value="item.id">{{ item.brand_name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Product
                                        Name</label>
                                    <div class="mt-2">
                                        <input type="text" v-model="productForm.product_name" id="name" required
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-10">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Type</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Add type for this product.</p>

                                <div v-for="item in data.types" :key="item.id">
                                    <TypeCard :data="item" :isCollapse="isTypeCardCollapse" @collapse="changeCollapseNumber"></TypeCard>
                                </div>

                                <div class="mt-5 text-center">
                                    <span class="mt-1 text-sm leading-6 text-blue-600 cursor-pointer hover:text-blue-900"
                                        @click="showTypeForm = true">+ Add Type</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <typeForm v-if="showTypeForm" @closeForm="showTypeForm = false"></typeForm>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <Link :href="route('admin.product')" class="text-sm font-semibold leading-6 text-gray-900">Cancel
                        </Link>
                        <button @click="handleSubmit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>

            </div>
        </div>
    </div>
</AuthenticatedLayout></template>
