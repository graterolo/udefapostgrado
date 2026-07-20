<template>
    <Head title="Mis Calificaciones" />

    <AuthenticatedLayout>
        <template #header>
            Control de Notas y Calificaciones
        </template>

        <!-- Ficha de Resumen del Estudiante -->
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <ul role="list" class="marker:text-indigo-400 list-disc pl-5 space-y-3 text-slate-500">
                    <p><b>Estudiante:</b> {{ props.alumno.nombre_completo }} </p>
                    <li><b>Cédula:</b> {{ props.alumno.cedula }}</li>
                    <li><b>Período Académico Activo:</b> {{ props.periodo.nombre }}</li>
                </ul>
            </div>
        </div>

        <!-- Tabla de Asignaturas Inscritas y Notas -->
        <div class="bg-white mt-6 grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Materia</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">U.C.</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Sección</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Modalidad</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">Nota Final</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(info, index) in calificaciones" :key="info.seccion_id" class="hover:bg-gray-50 focus-within:bg-gray-50">
                        <td class="border-t px-5 py-4 text-sm text-gray-600">{{ index + 1 }}</td>
                        <td class="border-t px-5 py-4 text-sm text-gray-950">{{ info.nombre_materia }}</td>
                        <td class="border-t px-5 py-4 text-center text-sm text-gray-600">{{ info.uc }}</td>
                        <td class="border-t px-5 py-4 text-sm text-gray-600">{{ info.nombre_seccion }}</td>

                        <!-- Modalidades de Estudio basadas en tus flags de base de datos -->
                        <td class="border-t px-5 py-4 text-sm text-gray-600">
                            <span v-if="info.modalidad == 0">Presencial</span>
                            <span v-else-if="info.modalidad == 1">Semi-Presencial</span>
                            <span v-else-if="info.modalidad == 2">Virtual</span>
                        </td>

                        <!-- Celda Calificación Final con semáforo de aprobación -->
                        <td class="border-t px-5 py-4 text-center text-sm">
                            <template v-if="info.nota_final !== null">
                                <span
                                    :class="info.nota_final > 9 ? 'text-green-800' : 'text-red-800'"
                                    class="px-3 py-1 rounded text-sm font-bold border"
                                >
                                    {{ info.nota_final }}
                                </span>
                            </template>
                            <template v-else>
                                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded text-xs font-semibold italic uppercase tracking-wider">
                                    Por Cargar
                                </span>
                            </template>
                        </td>
                    </tr>
                    <tr v-if="calificaciones.length === 0">
                        <td colspan="6" class="px-5 py-8 text-center text-gray-400 italic font-medium">
                            Usted no posee materias inscritas para el período académico actual.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    periodo: { type: Object },
    alumno: { type: Object },
    calificaciones: { type: Object }
});
</script>
