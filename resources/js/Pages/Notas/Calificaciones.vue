<template>
    <Head title="Módulo de Calificaciones" />

    <AuthenticatedLayout>
        <template #header>
            Módulo de Calificaciones
        </template>
        <!-- Filtro de Períodos Académicos -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white p-4 rounded-lg shadow-sm border border-gray-200 gap-4">
            <div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide">Carga Académica Docente</h3>
                <p class="text-xs text-gray-500 mt-1">
                    Visualizando información del período: <span class="font-semibold text-indigo-600">{{ props.periodo.nombre }}</span>
                </p>
            </div>

            <div class="flex items-center gap-2">
                <label for="periodo_select" class="text-xs font-bold text-gray-600 uppercase tracking-wider">
                    Cambiar Período:
                </label>
                <!-- Select conectado bidireccionalmente con v-model y escuchando el evento @change -->
                <select
                    id="periodo_select"
                    v-model="periodoSeleccionado"
                    @change="filtrarPorPeriodo"
                    class="block w-56 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xs uppercase font-medium tracking-wide bg-gray-50 p-2"
                >
                    <option v-for="p in props.periodos" :key="p.id" :value="p.id">
                        {{ p.nombre }}
                    </option>
                </select>
            </div>
        </div>
        <div class="flex items-center justify-between mb-6">
               <input v-model="searchTerm" type="text" class="w-2/4 mt-4 p-2 border border-gray-300 rounded-md" placeholder="Buscar docente...">
               <div class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
               Período: {{ props.periodo.nombre }}
               </div>
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
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificaciones', { cedula: doc.cedula })">
                                    {{ index + 1 }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <!-- <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificaciones', { cedula: doc.cedula })">
                                    {{ doc.nombre }}
                                </Link> -->
                                <Link
                                    :href="route('calificaciones', { cedula: doc.cedula, periodo_id: periodoSeleccionado })"
                                    class="text-indigo-600 hover:text-indigo-900 font-medium"
                                >
                                    {{ doc.nombre }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('calificaciones', { cedula: doc.cedula })">
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
import { Head, Link, router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { computed, defineProps, ref } from 'vue';

const props = defineProps({
    docentes: {type:Object},
    periodos: { type: Array },
    periodo: {type:Object}
});
const searchTerm = ref('');

const filteredDocentes = computed(() => {
    const searchTermLowerCase = searchTerm.value.toLowerCase();
    return props.docentes.data.filter(doc => {
        return doc.nombre.toLowerCase().includes(searchTermLowerCase) ||
               doc.cedula.includes(searchTermLowerCase);
    });
});

// Inicializamos la variable reactiva con el ID del período actual en pantalla
const periodoSeleccionado = ref(props.periodo.id);

// Esta función se ejecuta automáticamente cada vez que el administrador cambia la opción del select
const filtrarPorPeriodo = () => {
    router.get(
        route('notas.index'), // Apunta al método index de tu recurso 'notas'
        { periodo_id: periodoSeleccionado.value }, // Enviamos el parámetro que capturará el $request
        {
            preserveState: true,  // Mantiene el estado del componente (evita parpadeos bruscos)
            preserveScroll: true  // Evita que la página se reinicie al inicio del scroll
        }
    );
};

</script>
