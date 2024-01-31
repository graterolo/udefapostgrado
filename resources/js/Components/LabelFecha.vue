<script setup>
import { defineProps } from 'vue';
const props = defineProps(['value']);

</script>

<template>
    <span class="value">{{ 
        new Intl.DateTimeFormat("es").format(props.value)
        }}
</span>
</template>