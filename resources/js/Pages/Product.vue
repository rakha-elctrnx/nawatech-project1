<script setup>
import { Head, router, Link } from '@inertiajs/vue3';
import GuestHeader from '@/Components/GuestHeader.vue';
import { ref } from 'vue';

defineProps({
    data: {
        type: Object,
    },
    brand: {
        type: Object,
    }
});

const search = ref('')
let bran = ref('')

let showdd = ref(false)
const changeBrand = (value) => {
    bran.value = value;
    showdd.value = false
}

const handleSubmit = () => {
    router.post(route('product.index') + `?q=${search.value}&brand=${bran.value}` );
}

const currency = (value) => {
    return 'Rp. ' + new Intl.NumberFormat('id-ID').format(value)
}
</script>

<template>
    <Head title="Product" />

<GuestHeader></GuestHeader>
<section class="bg-white min-h-screen">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <div>
            
            <h1 class="mb-4 text-3xl font-extrabold text-gray-900 md:text-5xl lg:text-4xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Choose your </span>Favorite Motorbikes.</h1>
            
            <div class="flex justify-center">
                <div class="flex w-3/5">
                    <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your Email</label>
                    <button @click="showdd = !showdd" id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100" type="button">{{ bran === '' ? 'All Brands' : bran }} <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg></button>
                    <div v-if="showdd" id="dropdown" class="z-10 fixed mt-12 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                        <li v-for="item in brand">
                            <button @click="changeBrand(item.brand_name)" type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100">{{ item.brand_name }}</button>
                        </li>
                        </ul>
                    </div>
                    <div class="relative w-full">
                        <input type="search" v-model="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Motorbikes" required>
                        <button @click="handleSubmit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </div>

            <section class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">

                <!--   ✅ Product card 1 - Starts Here 👇 -->
                <div v-for="item in data" class="w-72 bg-white rounded-xl duration-500 hover:scale-105">
                <div>
                    <img :src="'/image/' + item.image" alt="Product" class=" object-cover rounded-t-xl" />
                    <div class="px-4 py-3 w-72">
                    <p class="text-gray-400 mr-3 my-1 uppercase text-xs text-left">{{ item.product.brand.brand_name }}</p>
                    <p class="text-lg font-bold text-black truncate block capitalize text-left">{{ item.type_name }}</p>
                    <div class="text-left">
                        <p class="text-sm text-gray-600 cursor-auto mt-3">Start From</p>
                        <p class="text-lg font-semibold text-black cursor-auto">{{ currency(item.price) }}</p>
                    </div>
                    <div class="flex justify-end mt-2">
                        <Link :href="route('product.detail', item.id)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            See Detail
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                        </Link>
                    </div>
                    </div>
                </div>
                </div>
                <!--   🛑 Product card 1 - Ends Here  -->


            </section>

        </div>
    </div>
</section>



    
</template>
