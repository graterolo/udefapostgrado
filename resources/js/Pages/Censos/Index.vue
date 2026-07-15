<template>
    <Head title="Control de Censos" />

    <AuthenticatedLayout>
        <template #header>
            Validación de Alumnos Censados
        </template>

        <!-- Buscador integrado con el backend -->
        <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3 flex gap-2 items-center">
                <input
                    v-model="searchTerm"
                    type="text"
                    class="block w-full mt-4 p-2 border border-gray-300 rounded-md"
                    placeholder="Buscar cédula o nombre en el censo..."
                    @keyup.enter="handleSearch"
                >
                <button
                    @click="handleSearch"
                    class="mt-4 px-4 py-2 bg-indigo-500 text-white rounded-md text-xs font-semibold uppercase tracking-wider hover:bg-indigo-600 transition"
                >
                    Buscar
                </button>
            </div>
        </div>

        <!-- Tabla de Datos -->
        <div class="bg-white mt-5 grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Cédula</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Postgrado/Maestría</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Fecha Censo</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">Estatus</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(censo, index) in censos.data" :key="censo.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t px-5 py-3 text-sm">{{ index + 1 }}</td>
                        <td class="border-t px-5 py-3 text-sm">{{ censo.nombre1 }} {{ censo.apellido1 }}</td>
                        <td class="border-t px-5 py-3 text-sm font-semibold">{{ censo.cedula }}</td>
                        <td class="border-t px-5 py-3 text-sm">{{ censo.nombre_maestria }}</td>
                        <td class="border-t px-5 py-3 text-sm">
                            <LabelFecha2 :value="censo.fecha" />
                        </td>
                        <td class="border-t px-5 py-3 text-center text-sm">
                            <span
                                :class="censo.validado === 1 ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800'"
                                class="px-2 py-0.5 rounded text-xs font-bold uppercase tracking-wider"
                            >
                                {{ censo.validado === 1 ? 'Validado' : 'Pendiente' }}
                            </span>
                        </td>
                        <td class="border-t px-5 py-3 text-center text-sm">
                            <button
                                v-if="censo.validado === 0"
                                @click="aprobarPago(censo.id)"
                                class="inline-flex items-center px-3 py-1 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-green-600 transition"
                            >
                                Validar Pago
                            </button>
                            <span v-else class="text-green-600 font-bold text-xs uppercase">Habilitado</span>
                        </td>
                    </tr>
                    <tr v-if="censos.data.length === 0">
                        <td colspan="7" class="px-5 py-8 text-center text-gray-400 italic">
                            No hay alumnos registrados en el censo con ese criterio de búsqueda.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Paginación nativa usando tu componente reutilizable -->
        <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
            <pagination :links="censos.links" />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, router, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import LabelFecha2 from '@/Components/LabelFecha2.vue';
import { defineProps, ref } from 'vue';

const props = defineProps({
    censos: { type: Object },
    filters: { type: Object }
});

// Vinculamos el input con lo que el backend tenga guardado en la URL
const searchTerm = ref(props.filters.search || '');
const formValidar = useForm({});

// Ejecuta la búsqueda real recargando el componente vía Inertia sin perder el estado del input
const handleSearch = () => {
    router.get(route('censos.index'), { search: searchTerm.value }, { preserveState: true });
};

// Lógica de confirmación y envío del patch
const aprobarPago = (id) => {
    if (confirm('¿Confirmas que este alumno pagó la preinscripción en el departamento administrativo?')) {
        formValidar.patch(route('censos.validar', id));
    }
};
</script>
