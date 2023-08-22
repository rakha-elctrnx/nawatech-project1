<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage()
const data = computed(() => page.props.data)


const deleteService = (id) => {
    // router.delete(route('service.delete', id))
}

</script>

<template>
    <Head title="Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <Link :href="route('admin.addProduct')" class="text-white bg-blue-600 hover:bg-blue-600/90 focus:ring-4 focus:outline-none focus:ring-blue-600/50 font-medium rounded-lg text-sm pr-5 pl-3 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mr-2 mb-2">
                        <span class="material-symbols-outlined pr-3">add_circle</span>
                        Add Product
                    </Link>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Brand
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data.data" :key="item.id" class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ (index + 1) + (data.current_page * 5) - 5 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.brand.brand_name }}
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ item.product_name }}
                                    </th>
                                    <th class="px-6 py-4">
                                        {{ item.types_count }} Type
                                    </th>
                                    <td class="px-6 py-4">
                                        <Link :href="route('admin.editProduct', item.id)" class="font-medium text-blue-600 hover:underline">Edit</Link>
                                        <span>&nbsp; &nbsp;</span>
                                        <button type="button" @click="deleteService(item.id)" class="font-medium text-red-600 hover:underline">Delete</button>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <nav class="flex items-center justify-between pt-4" aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-500">
                                Showing
                                <span class="font-semibold text-gray-900">{{ data.from }}</span>-
                                <span class="font-semibold text-gray-900">{{ data.to }}</span>
                                of
                                <span class="font-semibold text-gray-900">{{ data.total }}</span>
                            </span>
                            <ul class="inline-flex -space-x-px text-sm h-8">
                                <li>
                                    <Link :href="data.prev_page_url" class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">Previous</Link>
                                </li>
                                <!-- Iterasi untuk menampilkan tombol halaman -->
                                <li v-for="page in data.last_page" :key="page">
                                    <Link :href="data.path + '?page=' + page" :class="{ 'text-blue-600': page === data.current_page, 'text-gray-500': page !== data.current_page }" class="flex items-center justify-center px-3 h-8 leading-tight bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ page }}</Link>
                                </li>
                                <li>
                                    <Link :href="data.next_page_url" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">Next</Link>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
