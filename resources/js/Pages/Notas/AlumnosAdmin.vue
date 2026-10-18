<template>
    <Head title="Calificaciones por Alumno" />
    <AuthenticatedLayout>
        <template #header> Control de Calificaciones por Alumno y Período</template>

        <!-- Filtro de Períodos -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white p-4 rounded-lg shadow-sm border gap-4">
            <div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide">Matrícula Activa</h3>
                <p class="text-xs text-gray-500 mt-1">Período: <span class="font-semibold text-indigo-600">{{ props.periodo.nombre }}</span></p>
            </div>
            <div class="flex items-center gap-2">
                <select
                    id="periodo_select"
                    v-model="periodoSeleccionado"
                    @change="cambiarPeriodo"
                    class="block w-120 rounded-md border-gray-300 shadow-sm text-xs font-medium bg-gray-50 p-2 pr-10 uppercase tracking-wide focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option v-for="p in props.periodos" :key="p.id" :value="p.id">
                        {{ p.nombre }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Buscador inline -->
        <div class="mb-4 max-w-xs">
            <input v-model="searchTerm" type="text" class="block w-full p-2 border border-gray-300 rounded-md text-sm" placeholder="Filtrar por nombre o cédula...">
        </div>

        <!-- Tabla de Alumnos -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 border-b text-xs font-semibold text-gray-500 uppercase">
                        <th class="px-5 py-3 text-left">#</th>
                        <th class="px-5 py-3 text-left">Estudiante</th>
                        <th class="px-5 py-3 text-left">Cédula</th>
                        <th class="px-5 py-3 text-center">Materias Inscritas</th>
                        <th class="px-5 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(alumno, index) in filteredAlumnos" :key="alumno.id" class="hover:bg-gray-50 border-b">
                        <td class="px-5 py-4 text-sm text-gray-600">{{ index + 1 }}</td>
                        <td class="px-5 py-4 text-sm font-medium text-gray-950">{{ alumno.nombre_completo }}</td>
                        <td class="px-5 py-4 text-sm font-mono text-gray-600">{{ alumno.cedula }}</td>
                        <td class="px-5 py-4 text-sm text-center font-bold text-indigo-600">{{ alumno.materias_inscritas }}</td>
                        <td class="px-5 py-4 text-sm text-center">
                            <!-- Link directo que aprovecha la ruta del historial que creamos hoy -->
                            <Link :href="route('admin.reportes.historial', { cedula: alumno.cedula })" class="px-3 py-1 bg-indigo-600 text-white text-xs font-bold uppercase rounded shadow hover:bg-indigo-700">
                                Ver Historial
                            </Link>
                        </td>
                    </tr>
                    <tr v-if="filteredAlumnos.length === 0">
                        <td colspan="5" class="px-5 py-8 text-center text-gray-400 italic">No se encontraron estudiantes para este período.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
            <Pagination :links="alumnos.links" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({ periodo: Object, periodos: Array, alumnos: Object });
const periodoSeleccionado = ref(props.periodo.id);
const searchTerm = ref('');

const cambiarPeriodo = () => {
    router.get(route('admin.calificaciones.alumnos'), { periodo_id: periodoSeleccionado.value }, { preserveState: true });
};

const filteredAlumnos = computed(() => {
    const term = searchTerm.value.toLowerCase();
    return props.alumnos.data.filter(al => al.nombre_completo.toLowerCase().includes(term) || al.cedula.includes(term));
});
</script>
