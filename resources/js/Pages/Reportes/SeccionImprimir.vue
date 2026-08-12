<template>
    <Head title="Imprimir Acta de Sección" />

    <!-- CONTENEDOR PURO (Sin AuthenticatedLayout para evitar bloqueos de scroll) -->
    <div class="bg-white min-h-screen text-black p-6 font-sans">

        <!-- Botón flotante para activar la impresión (Se oculta al imprimir) -->
        <div class="print:hidden max-w-4xl mx-auto mb-6 flex justify-between items-center bg-indigo-50 p-4 rounded-lg border border-indigo-200">
            <span class="text-sm text-indigo-800 font-medium">
                Vista previa del formato oficial. Verifique los datos antes de imprimir o guardar como PDF.
            </span>
            <div class="flex gap-2">
                <!-- Botón para regresar a las secciones del docente -->
                <Link
                    :href="route('calificaciones', { cedula: props.docente.cedula })"
                    class="px-4 py-2 bg-gray-500 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-gray-600 transition"
                >
                    Volver
                </Link>
                <button
                    @click="ejecutarImpresion"
                    class="px-4 py-2 bg-indigo-600 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-indigo-700 transition"
                >
                    Imprimir Documento
                </button>
            </div>
        </div>

        <!-- Contenedor del Formato Institucional Limpio -->
        <ReporteLayout :docente-nombre="props.docente.nombre">

            <!-- Bloque de metadatos de la Sección (El cuadro informativo) -->
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
                Acta Oficial de Calificaciones / Lista de Clase
            </h2>
            <p class="text-center text-xs uppercase tracking-wider font-semibold text-gray-700 mb-6">
                {{ props.infoseccion.nombre_maestria }}
            </p>

            <!-- Tabla Simple y Limpia -->
            <table class="w-full border-collapse border border-gray-400 text-xs text-left">
                <thead>
                    <tr class="bg-gray-100 print:bg-transparent border-b border-gray-400">
                        <th class="border border-gray-400 px-4 py-2 text-center w-12">N°</th>
                        <th class="border border-gray-400 px-4 py-2 w-32">Cédula</th>
                        <th class="border border-gray-400 px-4 py-2">Apellidos y Nombres</th>
                        <th class="border border-gray-400 px-4 py-2 text-center w-24">Nota Final</th>
                        <th class="border border-gray-400 px-4 py-2 text-center w-36">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="alumno in inscritos" :key="alumno.cedula" class="border-b border-gray-400">
                        <td class="border border-gray-400 px-4 py-2 text-center">{{ alumno.num }}</td>
                        <td class="border border-gray-400 px-4 py-2 font-mono">{{ alumno.cedula }}</td>
                        <td class="border border-gray-400 px-4 py-2 uppercase font-medium">{{ alumno.nombre }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center font-bold text-sm">
                            {{ alumno.nota !== null ? alumno.nota + ' pts' : 'S/N' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-center text-[10px] text-gray-500 uppercase tracking-tight">
                            {{ alumno.nota === null ? 'Pendiente' : (alumno.nota > 9 ? 'Aprobado' : 'Reprobado') }}
                        </td>
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
    periodo: { type: Object },
    docente: { type: Object },
    infoseccion: { type: Object },
    inscritos: { type: Array }
});

const ejecutarImpresion = () => {
    window.print();
};
</script>

<style scoped>
/* CSS Limpio y definitivo para impresión nativa sin Layout entorpeciendo */
@media print {
    /* 1. Ocultamos los botones y elementos web de control */
    .print\:hidden {
        display: none !important;
    }

    /* 2. Forzamos que la tabla use las propiedades estándar de salto de página */
    table {
        width: 100% !important;
        border-collapse: collapse !important;
        page-break-inside: auto !important;
    }
    thead {
        display: table-header-group !important; /* Clona los títulos en la hoja 2 */
    }
    tr {
        page-break-inside: avoid !important;   /* Evita que un alumno se corte a la mitad */
        break-inside: avoid !important;
    }

    /* 3. Definición del tamaño del papel Carta Oficial con márgenes balanceados */
    @page {
        size: letter;
        margin: 2cm 1.5cm 2.5cm 1.5cm;
    }
}
</style>
