<template>
    <span class="value">{{ formatDate(value) }}</span>
</template>
  
<script setup>
  import { defineProps } from 'vue';
  
  const props = defineProps(['value']);
  
  function formatDate(dateTimeString) {
  // Crear un objeto Date desde la cadena de fecha y hora
  const dateTime = new Date(dateTimeString);

  // Formatear la fecha y hora en un formato legible
  const formattedDate = dateTime.toLocaleDateString('es', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  });

  return formattedDate;
}
</script>