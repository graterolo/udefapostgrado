<template>
    <Head title=" Carga Académica" />

    <AuthenticatedLayout>
        <template #header>
            Carga Académica
        </template>
                <div  class="mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200 ">
                    <Link :href="route('infoseccions.create')" 
                        class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                        >Nuevo</Link
                    >            
                </div>  
                
              <div class="bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Período</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Sección</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Modalidad</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Cupo</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="(info, index) in infoseccions.data" :key="info.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    {{ index + 1 }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    {{ info.pnombre }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    {{ info.nombre }}
                                </Link>
                            </td>
                            <td v-if=" info.modalidad==0" class="border-t" >
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    Presencial
                                </Link>
                            </td>
                            <td v-if=" info.modalidad==1" class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    Semi-Presencial
                                </Link>
                            </td>
                            <td v-if=" info.modalidad==2" class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    Virtual
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    {{ info.cupo }}
                                </Link>
                            </td>
                            <td class="border-t" v-if=" info.activo==0">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    Inactivo
                                </Link>
                            </td>
                            <td class="border-t" v-if=" info.activo==1">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('infoseccions.show', info.id)">
                                    Activo
                                </Link>
                            </td>
                           
                        </tr>
                    </tbody>
                </table>
            </div>
              <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="infoseccions.links" />
            </div>  

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';


const props = defineProps({
    infoseccions: {type:Object}
});
const form = useForm({
    id:''
});

</script>