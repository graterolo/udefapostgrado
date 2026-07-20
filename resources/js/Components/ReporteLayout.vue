<template>
    <div class="print-container bg-white p-4 max-w-4xl mx-auto text-black font-sans">
        <!-- Encabezado Institucional Reutilizable -->
        <div class="border-b-2 border-black pb-4 mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-md font-bold uppercase tracking-wide">Universidad de Falcón</h1>
                <p class="text-xs uppercase text-gray-600 font-semibold tracking-wider">Coordinación de Investigación y Postgrados </p>
                <p class="text-xs text-gray-500">Unidad de Admisión y Control de Estudios</p>
            </div>
            <div class="text-right text-xs text-gray-500">
                <p><b>Fecha de Emisión:</b> {{ fechaActual }}</p>
                <p class="print:hidden text-indigo-600 font-bold">Documento Oficial de Consulta</p>
            </div>
        </div>

        <!-- Cuerpo del Reporte (Aquí cae la tabla de alumnos) -->
        <div class="min-h-[500px]">
            <slot />
        </div>

        <!-- Pie de Página y Bloque de Firmas Reutilizable -->
        <div class="mt-16 pt-8 border-t border-gray-300 grid grid-cols-2 gap-12 text-center text-xs">
            <div class="flex flex-col items-center">
                <div class="w-48 border-b border-black mb-1 mt-10"></div>
                <p class="font-bold uppercase">{{ docenteNombre }}</p>
                <p class="text-gray-500">Firma del Docente</p>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-48 border-b border-black mb-1 mt-10"></div>
                <p class="font-bold uppercase">Control de Estudios</p>
                <p class="text-gray-500">Firma y Sello </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    docenteNombre: { type: String, default: 'N/A' }
});

const fechaActual = computed(() => new Date().toLocaleDateString('es-VE', {
    year: 'numeric', month: 'long', day: 'numeric'
}));
</script>

<style scoped>
@media print {
    .print-container {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
    }
    /* Buscamos el contenedor de las firmas y le prohibimos cortarse */
    .mt-16 { /* O la clase del contenedor de tus firmas */
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
}
</style>
