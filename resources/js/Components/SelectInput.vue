<template>
    <select 
    class="inblock mt-1 w-full rounded-md form-input focus:border-indigo-600" 
    :value="modelValue" 
    @change="$event => $emit('update:modelValue', $event.target.value)"
     ref="input">
    <option v-for="op in options" :key="op.id" :value="op.id">
    {{ op.nombre }}
    </option>
    </select>
</template>

<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue', 'options']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
defineExpose({focus: () => input.value.focus()});
</script>