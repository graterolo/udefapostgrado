<template>
    <Head title="Masters" />

    <AuthenticatedLayout>
        <template #header>
            Maestrias y Postgrados
        </template>
        <!-- v-if="hasPermission('empresas.create')"   v-if="$user->hasRole('empresas.create')"-->
                  <div  class="mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200 ">
                    <Link :href="route('masters.create')" 
                        class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                        >Nuevo</Link
                    >            
                </div>  
                
              <div class="bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Siglas</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Maestría/Postg.</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Estado</th>
                            <!-- <th class="pb-4 pt-6 px-6">Fecha Creación</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="(mas, index) in masters.data" :key="mas.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('masters.show', mas.id)">
                                    {{ index + 1 }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('masters.show', mas.id)">
                                    {{ mas.siglas }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('masters.show', mas.id)">
                                    {{ mas.nombre }}
                                </Link>
                            </td>
                            <td class="border-t" v-if=" mas.activo==0">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('masters.show', mas.id)">
                                    Inactivo
                                </Link>
                            </td>
                            <td class="border-t" v-if=" mas.activo==1">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('masters.show', mas.id)">
                                    Activo
                                </Link>
                            </td>                           
                        </tr>
                    </tbody>
                </table>
            </div>
              <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="masters.links" />
            </div>  

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';


const props = defineProps({
    masters: {type:Object}
});
const form = useForm({
    id:''
});

</script>