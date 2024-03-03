<template>
    <Head title="Carga Académica" />
    <AuthenticatedLayout>
        <template #header>
           Carga Académica
       </template>

       <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
         <div class="p-6 border-b border-gray-200">
            <ul role="list" class="marker:text-indigo-400 list-disc pl-5 space-y-3 text-slate-500">
              <p><b>Docente:</b>  {{ props.docente.nombre }} </p>
              <li><b>Período:</b> {{ props.periodo.nombre }}</li>
              
              <li><b>Total Horas:</b>
                {{ totalHorasAcademicas }}
              </li>
              
            </ul>
           
         </div>
       </div>
       <div class="bg-white overflow-hidden mt-6 shadow-sm sm:rounded-lg">
        <table class="w-full whitespace-nowrap">
          <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Día</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Sección</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Materia</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Mod.</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Hora Ent.</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Hora Sal.</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Aula</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-3 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Horas</th>
            
          </tr>
          <tr v-for="sec, i in infoseccions" :key="sec.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-b border-gray-200 bg-white px-3 py-5 text-sm">{{ (i+1) }}</td>
          <td v-if="sec.ndia && sec.ndia === 1" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">Lunes</td>
          <td v-if="sec.ndia && sec.ndia === 2" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">Martes</td>
          <td v-if="sec.ndia && sec.ndia === 3" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">Miércoles</td>
          <td v-if="sec.ndia && sec.ndia === 4" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">Jueves</td>
          <td v-if="sec.ndia && sec.ndia === 5" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">Viernes</td>
          <td v-if="sec.ndia && sec.ndia === 6" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">Sábado</td>
          <td v-if="!sec.ndia" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">-</td>
          <td class="border-b border-gray-200 bg-white px-3 py-5 text-sm">{{ sec.nombre }}</td>
          <td class="border-b border-gray-200 bg-white px-3 py-5 text-sm">{{ sec.pnombre }}</td>
          <td v-if=" sec.modalidad==0" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">P</td>
          <td v-if=" sec.modalidad==1" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">SP</td>
          <td v-if=" sec.modalidad==2" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">V</td>
          <td class="border-b border-gray-200 bg-white px-3 py-5 text-sm">{{ sec.hora_ent }}</td>
          <td class="border-b border-gray-200 bg-white px-3 py-5 text-sm">{{ sec.hora_sal }}</td>
          <td v-if="sec.codigo" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">{{ sec.codigo }}</td>
          <td v-else class="border-b border-gray-200 bg-white px-3 py-5 text-sm">-</td>
          <td v-if="sec.hora_ent" class="border-b border-gray-200 bg-white px-3 py-5 text-sm">{{ calcularHorasSeccion(sec) }}</td>
        </tr>        
        </table>
       </div>

    </AuthenticatedLayout>


</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';


const props = defineProps({
    periodo: { type: Object },
    docente: { type: Object },
    infoseccions: { type: Object },
    horas: { type: Object },
});
const totalHorasAcademicas = ref(0);

// Funcion para calcular las horas por cada seccion 
const calcularHorasSeccion = (seccion) => {
    const horasEnSeccion = props.horas.filter(hora =>
        hora.he >= seccion.hora_ent && hora.hs <= seccion.hora_sal
    ).length;

    return horasEnSeccion;
};

// Funcion para calcular las horas totales del docente
const calcularHorasAcademicas = () => {
    let totalHours = 0;

    props.infoseccions.forEach(sec => {
        const horasEnSeccion = props.horas.filter(hora =>
            hora.he >= sec.hora_ent && hora.hs <= sec.hora_sal
        ).length;

        totalHours += horasEnSeccion;
    });

    totalHorasAcademicas.value = totalHours;
};

// Llamo a la función una vez para calcular las horas académicas inmediatamente al cargar la página
calcularHorasAcademicas();

</script>