<template>
    <Head title="Plan de Estudios" />

    <AuthenticatedLayout>
        <template #header>
            Plan de Estudios
        </template>
        <div class="flex items-center justify-between mb-6">  
            <form @submit.prevent="$event => form.get(route('plans.index', { search: searchTerm }))" class="w-3/4">
                <input v-model="searchTerm" type="text" class="w-3/4 mt-4 p-2 border border-gray-300 rounded-md" placeholder="Buscar materia...">
            </form>          
               <Link :href="route('plans.create')" 
                   class="px-1 py-1 bg-indigo-500 text-white border rounded-md ">
                   Nuevo
               </Link>                      
        </div>
                
              <div class="bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Siglas</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Código</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Materia</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Semestre</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Hotas T.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="(plan, index) in plans.data" :key="plan.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.id)">
                                    {{ index + 1 }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.id)">
                                    {{ plan.siglas }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.id)">
                                    {{ plan.codigo }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.id)">
                                    {{ plan.nombre }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.id)">
                                    {{ plan.semestre }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.id)">
                                    {{ plan.horast }}
                                </Link>
                            </td>
                           
                        </tr>
                    </tbody>
                </table>
            </div>
              <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="plans.links" />
            </div>  

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { defineProps } from 'vue';

const props = defineProps({
    plans: {type:Object}
});

const form = useForm({
    searchTerm: '',
   
});


</script>