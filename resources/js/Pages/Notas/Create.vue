<template>
    <Head title=" Módulo de Calificaciones" />

    <AuthenticatedLayout>
        <template #header>
            Módulo de Calificaciones (Notas)
        </template> 
        <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <ul role="list" class="marker:text-indigo-400 list-disc pl-5 space-y-3 text-slate-500">
                    <p><b>Nombre del Docente:</b>  {{ props.docente.nombre }} </p>
                    <li><b>Período Académico:</b> {{ props.periodo.nombre }}</li>  
                    <li><b>Nombre de la Sección:</b> {{ props.infoseccion.nombre }}</li>
                    <li><b>Nombre de la Materia:</b> {{ props.infoseccion.pnombre }}</li>             
                </ul>           
            </div>
        </div>
        <div class=" justify-between flex flex-row space-x-2 mb-2 ">
            <div class="mt-10 text-2xl  text-gray-900 shadow-sm ">Alumnos inscritos en esta sección</div>              
       </div>
                
       <div class="bg-white mt-6 grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
       <form @submit.prevent="handleSubmit">
          <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
                <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Cédula</th>
                <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre</th>
                <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nota Final (sin decimales)</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(inscrito, index) in inscritos" :key="inscrito.id">
                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ index }}</td>
                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ inscrito.cedula }}</td>
                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ inscrito.nombre1 }} {{ inscrito.nombre2 }} {{ inscrito.apellido1 }} {{ inscrito.apellido2 }}</td>
                <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                    <input type="number" v-model="inscrito.nota" min="0" max="20" step="1" class="w-1/8 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    <input type="hidden" :name="'inscripciones[' + index + '][alumno_id]'" :value="inscrito.alumno_id">
                    <input type="hidden" :name="'inscripciones[' + index + '][infoseccion_id]'" :value="inscrito.infoseccion_id">
                    <input type="hidden" :name="'inscripciones[' + index + '][plan_id]'" :value="inscrito.plan_id">
                </td>
                </tr>
            </tbody>
          </table>
                <button type="submit" class="w-3/4 m-6 rounded-md bg-indigo-600 px-4 py-2 text-center text-sm text-white hover:bg-indigo-500">Guardar</button>
        </form>
       </div>       

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    periodo: {type:Object},
    docente: {type:Object},
    infoseccion: {type:Object},
    inscritos: { type: Array },
});

const handleSubmit = () => {
  router.post(route('notas.store'), {
    data: props.inscritos,
  });
};

</script>