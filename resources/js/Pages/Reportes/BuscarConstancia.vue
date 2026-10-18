<template>
    <Head title="Emitir Constancia" />
    <AuthenticatedLayout>
        <template #header> Reportes: Emisión de Constancia de Estudios </template>

        <div class="mt-5 max-w-md bg-white p-6 rounded-lg shadow-sm border">
            <form @submit.prevent="generar">
                <label class="block text-sm font-bold text-gray-700 uppercase">Cédula de Identidad del Alumno:</label>
                <input v-model="form.cedula" type="text" required class="block w-full mt-2 p-2 border border-gray-300 rounded-md" placeholder="Ej: 12345678">

                <button type="submit" class="mt-4 w-full px-4 py-2 bg-green-600 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-green-700 transition">
                    Generar Constancia Oficial
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ cedula: '' });
const generar = () => {
    form.get(route('admin.reportes.constancia'));
};
</script>
