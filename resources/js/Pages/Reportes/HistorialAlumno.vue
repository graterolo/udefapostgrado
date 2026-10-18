<template>
    <Head title="Historial Académico" />

    <AuthenticatedLayout>
        <template #header>
            Reportes: Historial Académico del Alumno
        </template>

        <!-- Botones de Control superiores -->
        <div class="mb-6 flex justify-between items-center bg-indigo-50 p-4 rounded-lg border border-indigo-200">
            <span class="text-sm text-indigo-800 font-medium">
                Historial completo de calificaciones del estudiante.
            </span>
            <Link
                :href="route('admin.reportes.buscar-historial')"
                class="px-4 py-2 bg-gray-500 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-gray-600 transition"
            >
                Volver al Buscador
            </Link>
            <Link
                :href="route('admin.reportes.imprimir-historial', { cedula: props.alumno.cedula })"
                class="px-4 py-2 bg-green-600 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-green-700 transition"
            >
                Generar Formato Oficial / Imprimir
            </Link>
        </div>

        <!-- Ficha de Resumen del Estudiante -->
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <ul role="list" class="marker:text-indigo-400 list-disc pl-5 space-y-3 text-slate-500">
                    <p><b>Estudiante:</b> {{ props.alumno.nombre_completo }} </p>
                    <li><b>Cédula:</b> {{ props.alumno.cedula }}</li>
                </ul>
            </div>
        </div>

        <!-- Tabla de Historial Completo -->
        <div class="bg-white mt-6 grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Período</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Materia</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">U.C.</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Sección</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">Nota Final</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(info, index) in calificaciones" :key="index" class="hover:bg-gray-50">
                        <td class="border-t px-5 py-4 text-sm text-gray-600">{{ index + 1 }}</td>
                        <td class="border-t px-5 py-4 text-sm text-indigo-900 font-semibold">{{ info.nombre_periodo }}</td>
                        <td class="border-t px-5 py-4 text-sm text-gray-950">{{ info.nombre_materia }}</td>
                        <td class="border-t px-5 py-4 text-center text-sm text-gray-600">{{ info.uc }}</td>
                        <td class="border-t px-5 py-4 text-sm text-gray-600">{{ info.nombre_seccion }}</td>

                        <!-- Calificación con semáforo -->
                        <td class="border-t px-5 py-4 text-center text-sm">
                            <template v-if="info.nota_final !== null">
                                <span
                                    :class="info.nota_final > 9 ? 'text-green-800 border-green-200 bg-green-50' : 'text-red-800 border-red-200 bg-red-50'"
                                    class="px-3 py-1 rounded text-sm font-bold border"
                                >
                                    {{ info.nota_final }} pts
                                </span>
                            </template>
                            <template v-else>
                                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded text-xs font-semibold italic uppercase tracking-wider">
                                    Sin Nota
                                </span>
                            </template>
                        </td>
                    </tr>
                    <tr v-if="calificaciones.length === 0">
                        <td colspan="6" class="px-5 py-8 text-center text-gray-400 italic">
                            El alumno no registra historial de materias en el sistema.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    alumno: { type: Object },
    calificaciones: { type: Array }
});
</script>
