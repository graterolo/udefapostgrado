<template>
    <Head title="Módulo de Inscripción" />

  <AuthenticatedLayout>
       <template #header>
           Módulo de Inscripción
       </template>

       <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
         <div class="p-6 border-b border-gray-200">
            <ul role="list" class="marker:text-indigo-400 list-disc pl-5 space-y-3 text-slate-500">
              <p><b>Alumno:</b>  {{ props.alumno.nombre1 }} {{ props.alumno.apellido1 }}</p>
              <li><b>Maestría o Postgrado:</b> {{ props.maestria.nombre }}</li>
              <li><b>Período:</b> {{ props.periodo.nperiodo }}</li>
              <li v-if="props.uc && props.uc.uc_disponibles">
              <b>UCs Pagadas:</b> {{ props.uc.uc_pagadas }} | <b>UCs Disponibles:</b>  {{ props.uc.uc_disponibles }} | <b>Fecha de Pago:</b> {{ props.uc.fecha }}
              </li>
              <li v-else><b>UCs Disponibles:</b>
               {{ props.uc.mensaje }}
              </li>
              <p>Presione el botón "Agregar" para seleccionar y añadir las materias correspondientes a su programa de estudio. 
                Debe tener saldo de UCs disponibles para agregar una materia.</p>
            </ul>
            <div class="mt-8 flex flex-row justify-end overflow-hidden shadow-sm sm:rounded-lg  ">
                  <PrimaryButton @click="openModal(1)">
                        Agregar
                  </PrimaryButton>
                </div>
         </div>
       </div>
       
       
       <div class=" justify-between flex flex-row space-x-2 mb-2 ">
            <div class="mt-10 text-2xl  text-gray-900 shadow-sm ">Secciones inscritas en este período</div>              
       </div>
       <div class="bg-white overflow-hidden mt-6 shadow-sm sm:rounded-lg">
        <table class="w-full whitespace-nowrap">
          <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Sección</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Materia</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"></th>
          </tr>
           <tr v-for="ins, i in insc" :key="ins.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ (i+1) }}</td>
          <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ ins.seccion }}</td>
          <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ ins.materia }}</td>
          <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
            <WarningButton @click="$event => openModal(2, alum, ins.infoseccion_id, ins.id)">
                    Editar
            </WarningButton>
            <button @click="$event => deleteSec(ins.id)" class="rounded-md bg-red-600 px-4 py-2 text-center text-sm text-white hover:bg-red-500 gap-6 ml-2">
                Eliminar
            </button></td> 
        </tr>
        <tr v-if="insc.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No hay secciones inscritas</td>
        </tr> 
        </table>
        <Modal :show="modal" @close="closeModal">
             <!-- Contenido del modal -->
             <h2 class="mt-2 p-2">{{ title }}</h2>
             <div class="mt-3 p-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
               <div class="sm:col-span-6">
                  <InputLabel for="infoseccion_id" value="Elija una Sección" />
                  <div class="mt-2">
                    <TextInput id="periodo" type="text"  v-model="form.periodo" style="display: none;" />
                      <select v-model="form.infoseccion_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required autofocus>
                             <option :value="null" disabled>Selecciona una opción</option>
                             <option v-for="sec in secciones" :key="sec.id" :value="sec.id">{{ sec.nombre }} - {{ sec.materia }} ({{ sec.uc }} UC)</option>
                           </select>
                      <InputError class="mt-2" :message="form.errors.infoseccion_id" />
                  </div>
               </div>     
               <div class="sm:col-span-2">
                 <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="save">
                    Agregar
                 </PrimaryButton>
               </div>
               <div class="sm:col-span-2"></div>
               <div class="sm:col-span-2">
                  <SecondaryButton :disabled="form.processing" @click="closeModal">
                    Cancelar 
                  </SecondaryButton>
                </div>   
            </div>


        </Modal>
       </div>



  </AuthenticatedLayout>
</template>




<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import { Head, useForm} from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';


const props = defineProps({
    errors: { type: Object },
    alumno: { type: Object },
    secciones: { type: Object },
    maestria: { type: Object },
    periodo: { type: Object },
    insc: { type: Object },
    uc: { type: Object },
});

const form = useForm({
    alumno_id: '',
    infoseccion_id: '',
    periodo_id: '',

});

const modal = ref(false);
const title = ref('');
const operacion = ref(1);
const id = ref('');
const alum = props.alumno.id;
const periodo = props.periodo.id;

const save = () => {
    if (operacion.value == 1) {
        form.post(route('inscripcions.store'), {
            onSuccess: () => {ok('Sección agregada')}
        });
    } else {
        form.put(route('inscripcions.update', id.value), {
            onSuccess: () => {ok('Sección actualizada')}
        });
    }
}
const ok = () => {
    form.reset();
    closeModal();
}

// Método para abrir el modal
const openModal = (op, alumno_id, infoseccion_id, inscripcion) => {
    modal.value = true;
    operacion.value = op;
    id.value = inscripcion;
    if(op == 1){
        title.value = 'Agregar Sección';
        form.alumno_id = alum;
        form.periodo_id = periodo;
    } else {
        title.value = 'Modificar Sección';
        form.alumno_id = alum;
        form.infoseccion_id =infoseccion_id;
        form.periodo_id = periodo;

    }
}

// Método para cerrar el modal
const closeModal = () => {
    modal.value = false;
    form.reset();
};

const deleteSec = (id) => {
  if (confirm('Está seguro de eliminar esta sección de clase?')) {
    form.delete(route('inscripcions.destroy', id));
  }
}


</script>