<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import GuestHeader from '@/Components/GuestHeader.vue';
import { ref } from 'vue';


defineProps({
    data: {
        type: Object,
    }
});

let activeTab = ref('Machine')

const changeTab = (value) => {
    activeTab.value = value
}

const createOrder = () => {
    router.post(route('order.create', usePage().props.data.id));
}

const currency = (value) => {
    return new Intl.NumberFormat('id-ID').format(value)
}
</script>

<template>
    <Head title="Welcome" />

    <GuestHeader></GuestHeader>
    <section class="bg-white min-h-screen">
        <div class="py-6">
            <!-- Breadcrumbs -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center space-x-2 text-gray-400 text-sm">
                    <span>{{ data.product.brand.brand_name }}</span>
                    <span>
                        <svg class="h-5 w-5 leading-none text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <span>{{ data.product.product_name }}</span>
                    <span>
                        <svg class="h-5 w-5 leading-none text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                    <span>{{ data.type_name }}</span>
                </div>
            </div>
            <!-- ./ Breadcrumbs -->

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="flex md:flex-row -mx-4 w-full">
                    <div class="md:flex-1 px-4 w-1/2">
                        <div class="w-full">
                            <div class="h-64 md:h-80 rounded-lg mb-4">
                                <img :src="'/image/' + data.image" class="w-full" alt="">
                            </div>

                            <div class="flex -mx-2 mb-4">
                                <template x-for="i in 4">
                                    <div class="flex-1 px-2">
                                        <button x-on:click="image = i"
                                            class="focus:outline-none w-full rounded-lg h-24 md:h-32 bg-gray-100 flex items-center justify-center">
                                            <span x-text="i" class="text-2xl"></span>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex-1 px-4 w-1/2">
                        <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-4xl">{{data.type_name}}</h2>
                        <p class="text-gray-500 text-sm">By <a href="#" class="text-indigo-600 hover:underline">{{data.product.brand.company_name}}</a></p>

                        <div class="flex items-center space-x-4 my-4">
                            <div>
                                <div class="rounded-lg bg-gray-100 flex py-2 px-3 mt-2">
                                    <span class="text-indigo-600 mr-1 mt-1">Rp. </span>
                                    <span class="font-bold text-indigo-600 text-3xl">{{ currency(data.price) }}</span>
                                </div>
                            </div>
                        </div>

                        <h1 class="text-xl mt-5">Specification</h1>
                        
                        <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px">
                                <li v-for="(spec, index) in data.groupedSpecs" class="mr-2 cursor-pointer">
                                    <div @click="changeTab(index)" :class="[activeTab === index ? 'inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active' : 'inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300']"
                                     >{{ index }}</div>
                                </li>
                            </ul>
                        </div>

                        <div v-for="(specs, index) in data.groupedSpecs">
                            <div v-if="activeTab === index" class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 mt-2">
                                    <tbody>
                                        <tr v-for="item in specs" class="bg-white border-b">
                                            <th class="px-6 py-4 font-medium text-gray-900 bg-slate-200 border-b border-slate-300 w-1/3">
                                                {{ item.name }}
                                            </th>
                                            <td class="px-6 py-4 text-left w-2/3">
                                                {{ item.value }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex py-4 space-x-4">

                        <button @click="createOrder"
                            class="h-14 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                            Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section></template>

