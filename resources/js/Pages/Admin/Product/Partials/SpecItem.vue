<script setup>
import { defineProps, watch, toRefs } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  data: Object
});

console.log(props.data);

const form = useForm({
    spec: props.data.spec,
    name: props.data.name,
    value: props.data.value,
});

// Using v-model to bind data with the parent component
// defineProps(['value']);
// watch(() => props.value, (newValue) => {
//     form.name = newValue.name;
//     form.value = newValue.value;
// });
</script>

<template>
    <div class="flex">
        <div class="mb-2 w-1/3 mr-2">
            <div class="mt-2">
                <input type="text" :value="form.name" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        <div class="mb-2 w-2/3">
            <div class="mt-2">
                <input type="text" :value="form.value" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
    </div>
</template>