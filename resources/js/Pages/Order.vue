<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import GuestHeader from '@/Components/GuestHeader.vue';

defineProps({
    data: {
        type: Object,
    }
});

const currency = (value) => {
    return 'Rp. ' + new Intl.NumberFormat('id-ID').format(value)
}

const handleCancel = (id) => {
    router.delete(route('order.cancel', id));
}

</script>

<template>
    <Head title="My Orders" />

<GuestHeader></GuestHeader>
<section class="bg-white min-h-screen">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <div class="flex justify-between">
            <h1 class="mb-10 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-4xl text-left">My Orders</h1>
            <a :href="route('order.export')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 h-fit text-center inline-flex items-center">
                Export
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
            </a>
        </div>

        <div class="w-full flex flex-col items-center gap-5">
            <div v-for="item in data" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:w-3/5 hover:bg-gray-100">
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" :src="'/image/' + item.type.image" alt="">
                <div class="flex flex-col w-1/2 h-48 justify-between items-start px-5 py-5">
                    <div class="text-left">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ item.type.product.brand.company_name }}</span>
                        <p class="text-gray-500 font-bold text-2xl">{{ item.type.product.brand.brand_name + ' ' + item.type.product.product_name }}</p>
                        <p class="text-gray-500">Type : {{ item.type.type_name }}</p>
                    </div>
                    <p class="text-blue-600 text-2xl font-medium">{{ currency(item.type.price) }}</p>
                </div>
                <div class="flex flex-col w-1/2 h-48 justify-between items-end items-start p-5">
                    <p>{{ item.date }}</p>
                    <button @click="handleCancel(item.id)" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Cancel Order</button>
                </div>
            </div>
        </div>
    </div>
    

</section>

    
</template>

