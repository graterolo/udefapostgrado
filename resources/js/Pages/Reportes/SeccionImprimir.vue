<template>
    <Head title="Imprimir Acta de Sección" />

    <AuthenticatedLayout>
        <!-- Botón flotante para activar la impresión (Oculto al imprimir físicamente) -->
        <div class="print:hidden max-w-4xl mx-auto mb-6 flex justify-between items-center bg-indigo-50 p-4 rounded-lg border border-indigo-200">
            <span class="text-sm text-indigo-800 font-medium">
                Vista previa del formato oficial. Verifique los datos antes de imprimir o guardar como PDF.
            </span>
            <div class="flex gap-2">
                <button
                    @click="ejecutarImpresion"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-center text-sm text-white hover:bg-indigo-500"
                >
                    Imprimir Documento
                </button>
                <!-- <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="ejecutarImpresion">
                    Imprimir Documento
                 </PrimaryButton> -->
            </div>
        </div>

        <!-- Contenedor del Formato Institucional Limpio -->
            <ReporteLayout :docente-nombre="props.docente.nombre">

                <!-- Bloque de metadatos de la Sección -->
                <div class="mb-6 grid grid-cols-2 gap-x-4 gap-y-2 text-xs uppercase tracking-wide border p-4 rounded bg-gray-50 print:bg-transparent print:border-none print:p-0">
                    <p><b>Programa / Postgrado:</b> {{ props.infoseccion.nombre_maestria }}</p>
                    <p><b>Materia:</b> {{ props.infoseccion.pnombre }}</p>
                    <p><b>Período Académico:</b> {{ props.periodo.nombre }}</p>
                    <p><b>Sección:</b> {{ props.infoseccion.nombre }}</p>
                    <p><b>Modalidad de Cátedra:</b>
                        <span v-if="props.infoseccion.modalidad == 0">Presencial</span>
                        <span v-else-if="props.infoseccion.modalidad == 1">Semi-Presencial</span>
                        <span v-else-if="props.infoseccion.modalidad == 2">Virtual</span>
                    </p>
                </div>

                <h2 class="text-center font-bold uppercase text-sm tracking-widest mb-4 underline">
                    Acta Oficial de Calificaciones / Listado
                </h2>

                <!-- Tabla Simple y Limpia sin colores de fondo -->
                <table class="w-full border-collapse border border-gray-400 text-xs text-left">
                    <thead>
                        <tr class="bg-gray-100 print:bg-transparent border-b border-gray-400">
                            <th class="border border-gray-400 px-4 py-2 text-center w-12">N°</th>
                            <th class="border border-gray-400 px-4 py-2 w-32">Cédula</th>
                            <th class="border border-gray-400 px-4 py-2">Apellidos y Nombres</th>
                            <th class="border border-gray-400 px-4 py-2 text-center w-24">Nota Final</th>
                            <!-- <th class="border border-gray-400 px-4 py-2 text-center w-36">Observaciones</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="alumno in inscritos" :key="alumno.cedula" class="border-b border-gray-400">
                            <td class="border border-gray-400 px-4 py-2 text-center">{{ alumno.num }}</td>
                            <td class="border border-gray-400 px-4 py-2 font-mono">{{ alumno.cedula }}</td>
                            <td class="border border-gray-400 px-4 py-2 uppercase font-medium">{{ alumno.nombre }}</td>
                            <td class="border border-gray-400 px-4 py-2 text-center font-bold text-sm">
                                {{ alumno.nota !== null ? alumno.nota : 'S/N' }}
                            </td>
                            <!-- <td class="border border-gray-400 px-4 py-2 text-center text-[10px] text-gray-500 uppercase tracking-tight">
                                {{ alumno.nota === null ? 'Pendiente' : (alumno.nota > 9 ? 'Aprobado' : 'Reprobado') }}
                            </td> -->
                        </tr>
                        <tr v-if="inscritos.length === 0">
                            <td colspan="5" class="border border-gray-400 px-4 py-8 text-center italic text-gray-500">
                                No se registran alumnos oficialmente inscritos en esta sección.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </ReporteLayout>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ReporteLayout from '@/Components/ReporteLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';

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

<style>
/* CSS Quirúrgico de Precisión para Impresión Universitaria */
@media print {
    /* 1. Ocultar ESPECÍFICAMENTE los componentes web del Layout sin romper los padres */
    /* Apagamos el menú lateral (nav, aside), la barra superior (header), y botones (no-print) */
    nav, header, aside, footer, button, .no-print, div[role="navigation"] {
        display: none !important;
    }

    /* 2. Forzar a todos los contenedores padres a perder su alto fijo y scrolls */
    html, body, #app, main, .bg-gray-100, .py-12 {
        background: #ffffff !important;
        background-color: #ffffff !important;
        color: #000000 !important;
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        overflow: visible !important;
        overflow-x: visible !important;
        overflow-y: visible !important;
        padding: 0 !important;
        margin: 0 !important;
        position: static !important;
    }

    /* 3. Asegurar que el formato de papelería se encuadre al tope de la hoja */
    .print-container {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        overflow: visible !important;
    }

    /* 4. Comportamiento de tablas e impresión fluida multifoja */
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

    /* 5. Configuración del tamaño Carta Oficial */
    @page {
        size: letter;
        margin: 2cm 1.5cm 2.5cm 1.5cm; /* Márgenes perfectos para archivado y firmas */
    }
}
</style>
