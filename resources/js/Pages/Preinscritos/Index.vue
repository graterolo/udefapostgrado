<template>
    <Head title="Alumnos Preinscritos" />

    <AuthenticatedLayout>
        <template #header>
            Alumnos Preinscritos
        </template>
                
            <div class="bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Cédula</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Postgrado/Maestria</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Fecha Registro</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="(pre, index) in preinscritos.data" :key="pre.id" class="text-gray-700">
                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ index + 1 }}</td>
                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ pre.nombre1 }} {{ pre.apellido1 }}</td>
                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ pre.cedula }}</td>
                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ pre.nombre }}</td>
                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm"><LabelFecha>{{ pre.updated_at }}</LabelFecha></td>
                            <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                 <Link :href="route('preinscritos.show', pre.id)" 
                                    class="px-4 py-2 bg-amber-400 text-white border rounded-md"
                                    >Mostrar</Link
                                > 
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
import LabelFecha from '@/Components/LabelFecha.vue';
//import { usePermission } from '@/Composable/Permission'

const props = defineProps({
    preinscritos: {type:Object}
});
const form = useForm({
    id:''
});
//const { hasPermission } = usePermission();

</script>