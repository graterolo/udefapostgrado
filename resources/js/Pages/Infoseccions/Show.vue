<template>
    <Head title="Sección" />

    <AuthenticatedLayout>
        <template #header>
            Sección
        </template>
        <div  class="overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end">
            <Link v-if="$page.props.auth.user.tipo === 2" :href="route('infoseccions.edit', infoseccion.id)" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Editar
            </Link>
            <Link :href="route('infoseccions.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado
            </Link>            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                  <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="seccion" value="Sección" />
                        <div class="mt-2">
                            <textarea name="seccion" id="seccion" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ infoseccion.nombre }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="plan_id" value="Nombre de la Materia" />
                        <div class="mt-2">
                            <textarea name="plan_id" id="plan_id" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ infoseccion.panombre }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="periodo_id" value="Período" />
                        <div class="mt-2">
                            <textarea name="periodo_id" id="periodo_id" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ infoseccion.pnombre }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="docente_id" value="Docente" />
                        <div class="mt-2">
                            <textarea name="docente_id" id="docente_id" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ infoseccion.dnombre }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="modalidad" value="Modalidad" />
                        <div class="mt-2">
                            <textarea name="modalidad" id="modalidad" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" infoseccion.modalidad==0">Presencial</textarea>
                            <textarea name="modalidad" id="modalidad" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" infoseccion.modalidad==1">Semi-Presencial</textarea>
                            <textarea name="modalidad" id="modalidad" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" infoseccion.modalidad==2">Virtual</textarea>
                        </div>
                    </div>      
                    <div class="sm:col-span-1">
                        <InputLabel for="cupo" value="Cupo" />
                        <div class="mt-2">
                            <textarea name="cupo" id="cupo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ infoseccion.cupo }}</textarea>
                        </div>
                    </div>  
                    <div class="sm:col-span-2">
                        <InputLabel for="activo" value="Estatus" />
                        <div class="mt-2">
                            <textarea name="activo" id="activo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" infoseccion.activo==0">Inactivo</textarea>
                        <textarea name="activo" id="activo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-else>Activo</textarea>
                        </div>
                    </div>   
                    <div class="sm:col-span-3">
                      <div class="mt-2">
                        <InputLabel for="updated_at" value="Ultima Actualización" />
                        <textarea
                            v-model="formattedDate"
                            name="updated_at"
                            id="updated_at"
                            rows="1"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            readonly
                        ></textarea>  
                      </div>
                    </div> 
                    <div class="sm:col-span-3">
                        <InputLabel for="updated_by" value="Actualizado Por" />
                        <div class="mt-2">
                            <textarea name="updated_by" id="updated_by" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ infoseccion.name }}</textarea>
                        </div>
                    </div>                 
                  </div>              
            </div>
        </div>
            <div class=" justify-between flex flex-row space-x-2 mb-2 ">
              <div class="mt-10 text-2xl  text-gray-900 shadow-sm ">Sesiones de Clase</div>
                <div class="mt-10 ml-10 overflow-hidden shadow-sm sm:rounded-lg  ">
                  <PrimaryButton @click="openModal(1)">
                        Agregar
                  </PrimaryButton>
                </div>
          </div>
        <div class="mt-6 bg-white rounded shadow overflow-x-auto">
           
         <table class="w-full whitespace-nowrap">
          <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">#</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Día</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Hora de Entrada</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Hora de Salida</th>
            <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"></th>
          </tr>
           <tr v-for="dia, i in dias" :key="dia.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ (i+1) }}</td>
          <td v-if="dia.ndia === 1" class="border-b border-gray-200 bg-white px-5 py-5 text-sm">Lunes</td>
          <td v-if="dia.ndia === 2" class="border-b border-gray-200 bg-white px-5 py-5 text-sm">Martes</td>
          <td v-if="dia.ndia === 3" class="border-b border-gray-200 bg-white px-5 py-5 text-sm">Miércoles</td>
          <td v-if="dia.ndia === 4" class="border-b border-gray-200 bg-white px-5 py-5 text-sm">Jueves</td>
          <td v-if="dia.ndia === 5" class="border-b border-gray-200 bg-white px-5 py-5 text-sm">Viernes</td>
          <td v-if="dia.ndia === 6" class="border-b border-gray-200 bg-white px-5 py-5 text-sm">Sábado</td>
          <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ dia.hora_ent }}</td>
          <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">{{ dia.hora_sal }}</td>
          <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
            <WarningButton @click="$event => openModal(2, dia.ndia, dia.hora_ent, dia.hora_sal, info, dia.id)">
                    Editar
            </WarningButton>
            <button @click="$event => deleteDia(dia.id)" class="rounded-md bg-red-600 px-4 py-2 text-center text-sm text-white hover:bg-red-500 gap-6 ml-2">
                Eliminar
            </button></td>
        </tr>
        <tr v-if="dias.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No hay sesiones de clase</td>
        </tr> 
        </table>
        <Modal :show="modal" @close="closeModal">
             <!-- Contenido del modal -->
             <h2 class="mt-2 p-2">{{ title }}</h2>
             <div class="mt-3 p-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
               <div class="sm:col-span-2">
                  <InputLabel for="ndia" value="Día" />
                  <div class="mt-2">
                      <!-- <TextInput id="id" type="text" v-model="form.id" style="display: none;" /> -->
                      <!-- <TextInput id="infoseccion_id" type="text" v-model="form.infoseccion_id" style="display: none;" /> -->
                      <!-- <TextInput id="ndia" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.ndia" ref="nameInputs" required  autocomplete="Dia" /> -->
                      <select id="ndia" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.ndia" required>
                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miércoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sábado</option>
                      </select>
                      <InputError class="mt-2" :message="form.errors.ndia" />
                  </div>
               </div>
               <div class="sm:col-span-2">
                  <InputLabel for="hora_ent" value="Hora Ent." />
                  <div class="mt-2">
                      <TextInput id="hora_ent" type="time" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.hora_ent" required  autocomplete="hora entrada" />
                      <InputError class="mt-2" :message="form.errors.hora_ent" />
                  </div>
               </div>
               <div class="sm:col-span-2">
                  <InputLabel for="hora_sal" value="Hora Sal." />
                  <div class="mt-2">
                      <TextInput id="hora_sal" type="time" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.hora_sal" required  autocomplete="hora salida" />
                      <InputError class="mt-2" :message="form.errors.hora_sal" />
                  </div>
               </div>
               <div class="sm:col-span-2">
                 <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="save">
                    Guardar
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
import InputLabel from '@/Components/InputLabel.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref, nextTick } from 'vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({ 
    infoseccion: {type:Object},
    dias: {type:Object},

});
const formattedDate = computed(() => new Date(props.infoseccion.updated_at).toLocaleDateString());


const modal = ref(false);
const nameInput = ref(null);
const title = ref('');
const operacion = ref(1);
const id = ref('');
const info = props.infoseccion.id;
const form = useForm({
    infoseccion_id: '', ndia: '', hora_ent: '', hora_sal: '',
});
const save = () => {
    if (operacion.value == 1) {
        form.post(route('dias.store'), {
            onSuccess: () => {ok('Sesión creada')}
        });
    } else {
        form.put(route('dias.update', id.value), {
            onSuccess: () => {ok('Sesión actualizada')}
        });
    }
}
const ok = () => {
    form.reset();
    closeModal();
}

// Método para abrir el modal
const openModal = (op, ndia, hora_ent, hora_sal, infoseccion_id, dia) => {
    modal.value = true;
    //nextTick(() => nameInput.value.focus());ref="nameInputs"
    operacion.value = op;
    id.value = dia;
    if(op == 1){
        title.value = 'Crear Sesión';
        form.infoseccion_id = info;
    } else {
        title.value = 'Editar Sesión';
        form.infoseccion_id = info;
        form.ndia =ndia;
        form.hora_ent=hora_ent;
        form.hora_sal=hora_sal;
    }
}

// Método para cerrar el modal
const closeModal = () => {
    modal.value = false;
    form.reset();
};

const deleteDia = (id) => {
  if (confirm('Está seguro de eliminar esta sesión de clase?')) {
    form.delete(route('dias.destroy', id));
  }
}

</script>