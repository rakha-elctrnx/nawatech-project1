<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import DeleteAlert from '@/Components/DeleteAlert.vue'


const page = usePage();
let data = page.props.data;

let isDelete = ref(false);
const url = ref('');

const handleDelete = (id) => {
    isDelete.value = true;
    url.value = route('admin.deleteBrand', { brand_id : id });
}

watch(() => usePage().props.data, (newData) => {
    data = newData;
});
</script>

<template>
    <Head title="Brand" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Brand</h2>
        </template>

        <DeleteAlert v-if="isDelete" :url="url" @closeAlert="isDelete = false"></DeleteAlert>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-7">

                    <Link :href="route('admin.addBrand')" class="text-white bg-blue-600 hover:bg-blue-600/90 focus:ring-4 focus:outline-none focus:ring-blue-600/50 font-medium rounded-lg text-sm pr-5 pl-3 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mr-2 mb-2">
                        <span class="material-symbols-outlined pr-3">add_circle</span>
                    Add Brand
                    </Link>

                    <div v-if="data.length == 0" class="flex justify-center my-10 text-slate-400">
                        No data yet
                    </div>

                    <section
                        class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-12 mb-5">

                        <div v-for="item in data" :key="item.id"
                            class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                            <img :src="'/logo/' + item.logo"
                                alt="logo" class="h-72 w-72 object-cover rounded-t-xl" />
                            <div class="px-4 py-3 w-72">
                                <span class="text-gray-400 mr-3 uppercase text-xs">{{ item.company_name }}</span>
                                <p class="text-lg font-bold text-black truncate block capitalize">{{ item.brand_name }}</p>
                                <div class="flex items-center">
                                    <div class="ml-auto">
                                        <Link :href="route('admin.editBrand', item.id)">
                                            <span class="material-symbols-outlined text-blue-500 hover:text-blue-300">border_color</span>
                                        </Link>
                                        <button @click="handleDelete(item.id)">
                                            <span class="material-symbols-outlined ml-3 text-red-500 hover:text-red-300">delete_forever</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
            </div>
        </div>
    </div>
</AuthenticatedLayout></template>
