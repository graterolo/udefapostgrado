<template>
    <Head title="Imprimir Lista de Asistencia" />

    <div class="bg-white min-h-screen text-black p-6 font-sans">
        <!-- Botón flotante para activar la impresión -->
        <div class="print:hidden max-w-4xl mx-auto mb-6 flex justify-between items-center bg-indigo-50 p-4 rounded-lg border border-indigo-200">
            <span class="text-sm text-indigo-800 font-medium">
                Formato Oficial de Control de Asistencia Física (12 Semanas).
            </span>
            <div class="flex gap-2">
                <Link
                    :href="route('notas.index')"
                    class="px-4 py-2 bg-gray-500 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-gray-600 transition"
                >
                    Volver
                </Link>
                <button
                    @click="window.print()"
                    class="px-4 py-2 bg-indigo-600 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-indigo-700 transition"
                >
                    Imprimir Control
                </button>
            </div>
        </div>

        <!-- Copiamos exactamente tu estructura institucional de ReporteLayout -->
        <ReporteLayout :docente-nombre="props.docente.nombre">
            <div class="mb-6 grid grid-cols-2 gap-x-4 gap-y-2 text-xs uppercase tracking-wide border border-gray-300 p-4 rounded bg-gray-50 print:bg-transparent print:border-none print:p-0">
                <p><b>Programa / Postgrado:</b> {{ props.infoseccion.nombre_maestria }}</p>
                <p><b>Período Académico:</b> {{ props.periodo.nombre }}</p>
                <p><b>Asignatura / Sección:</b> {{ props.infoseccion.nombre }}</p>
                <p><b>Modalidad de Cátedra:</b>
                    <span v-if="props.infoseccion.modalidad == 0">Presencial</span>
                    <span v-else-if="props.infoseccion.modalidad == 1">Semi-Presencial</span>
                    <span v-else-if="props.infoseccion.modalidad == 2">Virtual</span>
                </p>
            </div>

            <h2 class="text-center font-bold uppercase text-sm tracking-widest mb-1 underline">
                Control Oficial de Asistencia Estudiantil
            </h2>
            <p class="text-center text-xs uppercase tracking-wider font-semibold text-gray-700 mb-6">
                Registro Evaluativo Semanal
            </p>

            <table class="w-full border-collapse border border-gray-400 text-[10px] text-left">
                <thead>
                    <tr class="bg-gray-100 print:bg-transparent border-b border-gray-400">
                        <th class="border border-gray-400 px-2 py-2 text-center w-8">N°</th>
                        <th class="border border-gray-400 px-2 py-2 w-24">Cédula</th>
                        <th class="border border-gray-400 px-2 py-2">Apellidos y Nombres</th>
                        <!-- Generamos las 12 casillas semanales usando un bucle inline -->
                        <th v-for="semana in 12" :key="semana" class="border border-gray-400 text-center w-8 font-bold">
                            S{{ semana }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="alumno in inscritos" :key="alumno.cedula" class="border-b border-gray-400">
                        <td class="border border-gray-400 px-2 py-3 text-center">{{ alumno.num }}</td>
                        <td class="border border-gray-400 px-2 py-3 font-mono">{{ alumno.cedula }}</td>
                        <td class="border border-gray-400 px-2 py-3 uppercase font-medium">{{ alumno.nombre }}</td>
                        <!-- Celdas vacías perfectas para control manual con lapicero -->
                        <td v-for="semana in 12" :key="semana" class="border border-gray-400"></td>
                    </tr>
                </tbody>
            </table>
        </ReporteLayout>
    </div>
</template>

<script setup>
import ReporteLayout from '@/Components/ReporteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    periodo: Object,
    docente: Object,
    infoseccion: Object,
    inscritos: Array
});
</script>

<style scoped>
@media print {
    .print\:hidden {
        display: none !important;
    }
    table {
        width: 100% !important;
        border-collapse: collapse !important;
        page-break-inside: auto !important;
    }
    thead {
        display: table-header-group !important;
    }
    tr {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    @page {
        size: letter;
        margin: 2cm 1.5cm 2.5cm 1.5cm;
    }
}
</style>
