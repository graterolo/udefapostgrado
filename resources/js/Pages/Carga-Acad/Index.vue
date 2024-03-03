<template>
    <Head title="Carga Académica Docentes" />

    <AuthenticatedLayout>
        <template #header>
            Carga Académica Docentes
        </template>
        <div class="flex items-center justify-between mb-6">            
               <input v-model="searchTerm" type="text" class="w-2/4 mt-4 p-2 border border-gray-300 rounded-md" placeholder="Buscar docente...">                     
        </div>       
            <div class="bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre</th>
                            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Cédula</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="(doc, index) in filteredDocentes" :key="doc.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('cargadoc', { cedula: doc.cedula })">
                                    {{ index + 1 }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('cargadoc', { cedula: doc.cedula })">
                                    {{ doc.nombre }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('cargadoc', { cedula: doc.cedula })">
                                    {{ doc.cedula }}
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
              <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="docentes.links" />
            </div>  

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { computed, defineProps, ref } from 'vue';

const props = defineProps({
    docentes: {type:Object}
});
const searchTerm = ref('');

const filteredDocentes = computed(() => {
    const searchTermLowerCase = searchTerm.value.toLowerCase();
    return props.docentes.data.filter(doc => {
        return doc.nombre.toLowerCase().includes(searchTermLowerCase) ||
               doc.cedula.includes(searchTermLowerCase);
    });
});

</script>