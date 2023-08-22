<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const data = usePage().props.data;
const typeForm = useForm({
    type_name: '',
    price: '',
    image: null
})

const imagePreview = ref('');
const handleImageChange = (event) => {
    const file = event.target.files[0];
    typeForm.image = file;
    if (file) {
        imagePreview.value = URL.createObjectURL(file);
    }
    console.log(typeForm.product_id);
};

const handleTypeStore = () => {
    typeForm.post(route('admin.storeType', data.id), {
    onSuccess: () => {
        emits('closeForm');
    }
  });
};

const emits = defineEmits(['closeForm']);
</script>

<template>
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="font-bold">
                    Create Product Type
                </div>
                <div class="sm:items-start">
                    <div class="mt-2 flex w-full">
                        <div class="mb-2 w-1/2 mr-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Type
                                Name</label>
                            <div class="mt-2">
                                <input type="text" v-model="typeForm.type_name" id="name" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="mb-2 w-1/2">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                            <div class="mt-2">
                                <input type="text" v-model="typeForm.price" id="name" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 flex w-full">
                        <div class="w-1/2">
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="small_size">Image</label>
                            <input v-on:change="handleImageChange" class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg p-2 cursor-pointer bg-gray-50 focus:outline-none" id="small_size" type="file">
                        </div>
                        <div class="w-1/2 mt-8 flex items-center justify-center">
                        <img class="rounded-lg" style="width: 200px;" :src="imagePreview" alt="Logo" >
                    </div>
                    </div>
                </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button @click="handleTypeStore" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Save</button>
                    <button @click="emits('closeForm')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>