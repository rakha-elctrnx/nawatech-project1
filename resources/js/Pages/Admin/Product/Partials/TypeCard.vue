<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3';
import { defineEmits, defineProps, ref } from 'vue';
import SpecForm from './SpecForm.vue';

const props = defineProps({
  data: Object,
  isCollapse: Number
});
const emits = defineEmits(['collapse']);

let spec = [];
spec = props.data.grouped_specs;


const form = useForm({
    type_name: props.data.type_name,
    price: props.data.price,
    image: null,
    spec: spec
})

const imagePreview = ref('/image/' + props.data.image);

const handleImageChange = (event) => {
    const file = event.target.files[0];
    console.log(file);
    form.image = file;
    if (file) {
        imagePreview.value = URL.createObjectURL(file);
    }
};

let specsTab = ref(1);
const activeClass = 'inline-block p-4 text-blue-600 bg-gray-200 rounded-t-lg active cursor-pointer';
const inactiveClass = 'inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 cursor-pointer';

let typeOfSpec = ref('');
let showSpecForm = ref(false);

const addSpec = (typeSpec) => {
    typeOfSpec.value = typeSpec;
    showSpecForm.value = true;  
}

const handleDeleteSpec = (specId) => {
    router.delete(route('admin.deleteSpec', specId), {
        onSuccess: () => {
            window.location.href = route('admin.editProduct', props.data.product_id);
        }
    });
}

const handleUpdate = () => {
    form.post(route('admin.updateType', props.data.id), {
        onSuccess: () => {
            window.location.href = route('admin.editProduct', props.data.product_id);
        }
    });
}
</script>

<template>
    <SpecForm v-if="showSpecForm" @closeForm="showSpecForm = false" :type-spec="typeOfSpec" :type-id="data.id"></SpecForm>
    <section class="my-5 flex p-2 bg-slate-200 rounded-lg">
        <div class="flex w-1/5 p-2">
            <span v-if="isCollapse === data.id" class="material-symbols-outlined bg-blue-500 rounded-md text-white cursor-pointer max-h-6" @click="emits('collapse', 0)">remove</span>
            <span v-else class="material-symbols-outlined bg-blue-500 rounded-md text-white cursor-pointer" @click="emits('collapse', data.id)">add</span> 
            <span class="font-bold ml-2">{{ data.type_name }}</span>
        </div>
        <div class="w-4/5 px-2 pt-2">
            <div class="text-sm text-slate-600 w-full">Klik untuk melihat detail atau melipatnya
            </div>
            <div class="gap-2 bg-slate-100 p-3 mt-4 mb-2 rounded-lg" :class="{ hidden: isCollapse !== data.id }">
                <div class="flex">
                    <div class="mb-2 w-1/2 mr-2">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Type
                            Name</label>
                        <div class="mt-2">
                            <input type="text" v-model="form.type_name" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="mb-2 w-1/2">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                        <div class="mt-2">
                            <input type="text" v-model="form.price" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/2 mt-5">
                        <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                        <div class="flex items-center justify-center w-full mt-2">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click
                                            to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG
                                    </p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" required v-on:change="handleImageChange"/>
                            </label>
                        </div>
                    </div>
                    <div class="w-1/2 mt-5 flex items-center justify-center">
                        <img class="rounded-lg" style="height: 200px;" :src="imagePreview" alt="Logo">
                    </div>
                </div>
                <div class="mt-5">
                    <div class="mb-3 font-bold">Specification</div>
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                        <li class="mr-2">
                            <div @click="specsTab = 1" :class="{ [activeClass]: specsTab === 1, [inactiveClass]: specsTab !== 1 }">Machine</div>
                        </li>
                        <li class="mr-2">
                            <div @click="specsTab = 2" :class="{ [activeClass]: specsTab === 2, [inactiveClass]: specsTab !== 2 }">Frame</div>
                        </li>
                        <li class="mr-2">
                            <div @click="specsTab = 3" :class="{ [activeClass]: specsTab === 3, [inactiveClass]: specsTab !== 3 }">Dimension</div>
                        </li>
                        <li class="mr-2">
                            <div @click="specsTab = 4" :class="{ [activeClass]: specsTab === 4, [inactiveClass]: specsTab !== 4 }">Capacity</div>
                        </li>
                        <li class="mr-2">
                            <div @click="specsTab = 5" :class="{ [activeClass]: specsTab === 5, [inactiveClass]: specsTab !== 5 }">Electricity</div>
                        </li>
                    </ul>
                    <div class="p-3" v-if="specsTab === 1">
                        <div class="flex">
                            <div class="w-1/3 mr-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Spec Name</label>
                            </div>
                            <div class="w-2/3">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Value</label>
                            </div>
                        </div>                            
                        <div class="flex" v-for="(item, index) in spec.Machine" :key="index">
                            <div class="mb-2 w-1/3 mr-2">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Machine[index].name" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="mb-2 w-2/3">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Machine[index].value" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="w-[30px] flex items-center p-2"><span @click="handleDeleteSpec(form.spec.Machine[index].id)" class="material-symbols-outlined text-red-500 cursor-pointer">delete</span></div>
                        </div>
                        <div class="mt-5 w-full text-center">
                                <span class="mt-1 text-sm leading-6 text-blue-600 cursor-pointer hover:text-blue-900"
                                    @click="addSpec('Machine')">+ Add Specification</span>
                        </div>
                    </div>
                    <div class="p-3" v-if="specsTab === 2">
                        <div class="flex">
                            <div class="w-1/3 mr-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Spec Name</label>
                            </div>
                            <div class="w-2/3">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Value</label>
                            </div>
                        </div>                            
                        <div class="flex" v-for="(item, index) in spec.Frame" :key="index">
                            <div class="mb-2 w-1/3 mr-2">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Frame[index].name" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="mb-2 w-2/3">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Frame[index].value" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="w-[30px] flex items-center p-2"><span @click="handleDeleteSpec(form.spec.Frame[index].id)" class="material-symbols-outlined text-red-500 cursor-pointer">delete</span></div>
                        </div>
                        <div class="mt-5 w-full text-center">
                                <span class="mt-1 text-sm leading-6 text-blue-600 cursor-pointer hover:text-blue-900"
                                    @click="addSpec('Frame')">+ Add Specification</span>
                        </div>
                    </div>
                    <div class="p-3" v-if="specsTab === 3">
                        <div class="flex">
                            <div class="w-1/3 mr-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Spec Name</label>
                            </div>
                            <div class="w-2/3">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Value</label>
                            </div>
                        </div>                            
                        <div class="flex" v-for="(item, index) in spec.Dimension" :key="index">
                            <div class="mb-2 w-1/3 mr-2">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Dimension[index].name" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="mb-2 w-2/3">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Dimension[index].value" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="w-[30px] flex items-center p-2"><span @click="handleDeleteSpec(form.spec.Dimension[index].id)" class="material-symbols-outlined text-red-500 cursor-pointer">delete</span></div>
                        </div>
                        <div class="mt-5 w-full text-center">
                                <span class="mt-1 text-sm leading-6 text-blue-600 cursor-pointer hover:text-blue-900"
                                    @click="addSpec('Dimension')">+ Add Specification</span>
                        </div>
                    </div>
                    <div class="p-3" v-if="specsTab === 4">
                        <div class="flex">
                            <div class="w-1/3 mr-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Spec Name</label>
                            </div>
                            <div class="w-2/3">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Value</label>
                            </div>
                        </div>                            
                        <div class="flex" v-for="(item, index) in spec.Capacity" :key="index">
                            <div class="mb-2 w-1/3 mr-2">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Capacity[index].name" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="mb-2 w-2/3">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Capacity[index].value" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="w-[30px] flex items-center p-2"><span @click="handleDeleteSpec(form.spec.Capacity[index].id)" class="material-symbols-outlined text-red-500 cursor-pointer">delete</span></div>
                        </div>
                        <div class="mt-5 w-full text-center">
                                <span class="mt-1 text-sm leading-6 text-blue-600 cursor-pointer hover:text-blue-900"
                                    @click="addSpec('Capacity')">+ Add Specification</span>
                        </div>
                    </div>
                    <div class="p-3" v-if="specsTab === 5">
                        <div class="flex">
                            <div class="w-1/3 mr-2">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Spec Name</label>
                            </div>
                            <div class="w-2/3">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Value</label>
                            </div>
                        </div>                            
                        <div class="flex" v-for="(item, index) in spec.Electricity" :key="index">
                            <div class="mb-2 w-1/3 mr-2">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Electricity[index].name" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="mb-2 w-2/3">
                                <div class="mt-2">
                                    <input type="text" v-model="form.spec.Electricity[index].value" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="w-[30px] flex items-center p-2"><span @click="handleDeleteSpec(form.spec.Electricity[index].id)" class="material-symbols-outlined text-red-500 cursor-pointer">delete</span></div>
                        </div>
                        <div class="mt-5 w-full text-center">
                                <span class="mt-1 text-sm leading-6 text-blue-600 cursor-pointer hover:text-blue-900"
                                    @click="addSpec('Electricity')">+ Add Specification</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-end gap-x-2 border-t-2 pt-3">
                    <button @click="handleSubmit"
                            class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
                        <button @click="handleUpdate"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </div>
        </div>

    </section>
</template>