<template>
    <Head title="Alumnos Preinscritos" />

    <AuthenticatedLayout>
        <template #header>
            Alumnos Preinscritos
        </template>
        <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <input v-model="searchTerm" type="text" class="block w-full mt-4 p-2 border border-gray-300 rounded-md" placeholder="Buscar alumno...">
            </div>
        </div>
                
            <div class="bg-white mt-5 grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Cédula</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Postgrado/Maestria</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Fecha Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="(pre, index) in filteredPreinscritos" :key="pre.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('preinscritos.show', pre.id)">
                                    {{ index + 1 }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('preinscritos.show', pre.id)">
                                    {{ pre.nombre1 }} {{ pre.apellido1 }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('preinscritos.show', pre.id)">
                                    {{ pre.cedula }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('preinscritos.show', pre.id)">
                                    {{ pre.nombre }}
                                </Link>
                            </td>
                            <td class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm">
                                <LabelFecha2 :value="pre.updated_at" />
                            </td>                          
                        </tr>
                    </tbody>
                </table>
            </div>
              <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="preinscritos.links" />
            </div>  

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import LabelFecha2 from '@/Components/LabelFecha2.vue';
import { computed, defineProps, ref } from 'vue';

const props = defineProps({
    preinscritos: {type:Object}
});
const searchTerm = ref('');

const filteredPreinscritos = computed(() => {
    const searchTermLowerCase = searchTerm.value.toLowerCase();
    return props.preinscritos.data.filter(pre => {
        return pre.nombre1.toLowerCase().includes(searchTermLowerCase) ||
               pre.apellido1.toLowerCase().includes(searchTermLowerCase) ||
               pre.cedula.includes(searchTermLowerCase);
    });
});


</script>