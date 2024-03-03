<template>
    <Head title=" Módulo de Calificaciones" />

    <AuthenticatedLayout>
        <template #header>
            Módulo de Calificaciones (Docente)
        </template> 
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <ul role="list" class="marker:text-indigo-400 list-disc pl-5 space-y-3 text-slate-500">
                    <p><b>Docente:</b>  {{ props.docente.nombre }} </p>
                    <li><b>Período:</b> {{ props.periodo.nombre }}</li>               
                </ul>           
            </div>
        </div>
                
              <div class="bg-white mt-6 grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Sección</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Modalidad</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre de la Materia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="(info, index) in infoseccions" :key="info.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificacion', { seccion: info.id })">
                                    {{ index + 1 }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificacion', { seccion: info.id })">
                                    {{ info.nombre }}
                                </Link>
                            </td>
                            <td v-if=" info.modalidad==0" class="border-t" >
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificacion', { seccion: info.id })">
                                    Presencial
                                </Link>
                            </td>
                            <td v-if=" info.modalidad==1" class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificacion', { seccion: info.id })">
                                    Semi-Presencial
                                </Link>
                            </td>
                            <td v-if=" info.modalidad==2" class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificacion', { seccion: info.id })">
                                    Virtual
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificacion', { seccion: info.id })">
                                    {{ info.pnombre }}
                                </Link>
                            </td>                           
                        </tr>
                    </tbody>
                </table>
            </div>       

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    periodo: {type:Object},
    docente: {type:Object},
    infoseccions: {type:Object},
});
const form = useForm({
    id:''
});

</script>