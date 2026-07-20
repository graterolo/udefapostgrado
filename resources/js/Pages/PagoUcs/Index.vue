<template>
    <Head title="Carga de UCs" />

    <AuthenticatedLayout>
        <template #header>
            Control Administrativo de Unidades de Crédito (Pago UCs)
        </template>

        <!-- Buscador -->
        <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3 flex gap-2 items-center">
                <input
                    v-model="searchTerm"
                    type="text"
                    class="block w-full mt-4 p-2 border border-gray-300 rounded-md"
                    placeholder="Buscar por cédula o nombre..."
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

        <!-- Tabla de Alumnos y Saldos de UC -->
        <div class="bg-white mt-5 grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Cédula</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Postgrado/Maestría</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">Último Pago UC</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">UC Disponibles</th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-600">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in alumnosUcs.data" :key="item.cedula" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t px-5 py-3 text-sm">{{ index + 1 }}</td>
                        <td class="border-t px-5 py-3 text-sm font-medium text-gray-900">{{ item.nombre1 }} {{ item.apellido1 }}</td>
                        <td class="border-t px-5 py-3 text-sm font-semibold">{{ item.cedula }}</td>
                        <td class="border-t px-5 py-3 text-sm text-gray-500">{{ item.nombre_maestria }}</td>
                        <td class="border-t px-5 py-3 text-center text-sm font-medium text-blue-600">
                            {{ item.uc_pagadas }} UC
                        </td>
                        <td class="border-t px-5 py-3 text-center text-sm">
                            <span
                                :class="item.uc_disponibles > 0 ? 'text-green-800' : 'text-red-800'"
                                class="px-3 py-1 rounded-full text-xs font-bold"
                            >
                                {{ item.uc_disponibles }} UC
                            </span>
                        </td>
                        <td class="border-t px-5 py-3 text-center text-sm">
                            <button
                                @click="abrirModalCarga(item)"
                                class="inline-flex items-center px-3 py-1.5 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-green-600 transition"
                            >
                                Agregar
                            </button>
                        </td>
                    </tr>
                    <tr v-if="alumnosUcs.data.length === 0">
                        <td colspan="7" class="px-5 py-8 text-center text-gray-400 italic">
                            No se encontraron alumnos preinscritos con el criterio ingresado.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Paginación Reutilizable -->
        <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
            <pagination :links="alumnosUcs.links" />
        </div>

        <!-- VENTANA MODAL FLOTANTE (Nativa de Tailwind CSS) -->
        <div v-if="modalAbierto" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 overflow-y-auto">
            <div class="bg-white rounded-lg max-w-md w-full p-6 shadow-xl transform transition-all">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-4">
                    Cargar Unidades de Crédito
                </h3>

                <div class="space-y-3 text-sm text-gray-600 mb-4 bg-gray-50 p-3 rounded">
                    <p><strong>Alumno:</strong> {{ alumnoSeleccionado.nombre1 }} {{ alumnoSeleccionado.apellido1 }}</p>
                    <p><strong>Cédula:</strong> {{ alumnoSeleccionado.cedula }}</p>
                    <p><strong>Saldo Actual disponible:</strong> <span class="font-bold text-gray-900">{{ alumnoSeleccionado.uc_disponibles }} UC</span></p>
                </div>

                <form @submit.prevent="submitFormCarga">
                    <div>
                        <label for="uc_input" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                            Cantidad de UC a Inyectar/Agregar
                        </label>
                        <input
                            id="uc_input"
                            v-model="formCarga.uc_a_cargar"
                            type="number"
                            min="1"
                            max="50"
                            required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Ej: 3"
                        />
                    </div>

                    <div class="mt-6 flex justify-end gap-2 border-t pt-3">
                        <button
                            type="button"
                            @click="cerrarModal"
                            class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold text-xs rounded-md uppercase hover:bg-gray-300 transition"
                        >
                            Cancelar
                        </button>
                        <button
                            type="submit"
                            :disabled="formCarga.processing"
                            class="px-4 py-2 bg-green-600 text-white font-semibold text-xs rounded-md uppercase hover:bg-green-700 disabled:opacity-50 transition"
                        >
                            {{ formCarga.processing ? 'Guardando...' : 'Confirmar Carga' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { defineProps, ref } from 'vue';

const props = defineProps({
    alumnosUcs: { type: Object },
    filters: { type: Object }
});

const searchTerm = ref(props.filters.search || '');

// Estados para el control del Modal Flotante
const modalAbierto = ref(false);
const alumnoSeleccionado = ref(null);

// Formulario reactivo de Inertia
const formCarga = useForm({
    cedula: '',
    uc_a_cargar: ''
});

const handleSearch = () => {
    router.get(route('pagoucs.index'), { search: searchTerm.value }, { preserveState: true });
};

const abrirModalCarga = (alumno) => {
    alumnoSeleccionado.value = alumno;
    formCarga.cedula = alumno.cedula;
    formCarga.uc_a_cargar = '';
    modalAbierto.value = true;
};

const cerrarModal = () => {
    modalAbierto.value = false;
    alumnoSeleccionado.value = null;
};

const submitFormCarga = () => {
    formCarga.post(route('pagoucs.cargar'), {
        onSuccess: () => {
            cerrarModal();
        }
    });
};
</script>
