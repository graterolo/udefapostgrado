<template>
    <Head title="Agregar Sección" />

    <AuthenticatedLayout>
        <template #header>
            Agregar Sección
        </template>
         <div  class="mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200 ">
            <Link :href="route('infoseccions.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado</Link
            >            
        </div> 

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.post(route('infoseccions.store'))" >
                 <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="plan_id" value="Materia" />
                        <div class="mt-2">
                           <select v-model="form.plan_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required autofocus>
                             <option :value="null" disabled>Selecciona una opción</option>
                             <option v-for="plan in plans" :key="plan.id" :value="plan.id">{{ plan.codigo }} - {{ plan.nombre }}</option>
                           </select>
                        <InputError class="mt-2" :message="form.errors.plan_id" />
                        </div>
                    </div>
                    <!-- Por ahora el periodo lo busco en el controlador para escoger el ultimo activo -->
                    <!-- <div class="sm:col-span-3">
                        <InputLabel for="periodo_id" value="Período" />
                        <div class="mt-2">
                            <SelectInput id="periodo_id" :options="periodos" type="text" v-model="form.periodo_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required >
                            </SelectInput>
                            <InputError class="mt-2" :message="form.errors.periodo_id" />
                        </div>
                    </div> -->
                    <div class="sm:col-span-3">
                        <InputLabel for="docente_id" value="Docente" />
                        <div class="mt-2">
                            <SelectInput id="docente_id" :options="docentes" type="text" v-model="form.docente_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required >
                            </SelectInput>
                            <InputError class="mt-2" :message="form.errors.docente_id" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <InputLabel for="modalidad" value="Modalidad" />
                        <div class="mt-2">
                            <select id="modalidad" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.modalidad" required>
                                <option value="0">Presencial</option>
                                <option value="1">Semi-presencial</option>
                                <option value="2">Virtual</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.modalidad" />
                        </div>
                    </div>      
                    <div class="sm:col-span-2">
                        <InputLabel for="cupo" value="Cupo" />
                        <div class="mt-2">
                            <TextInput id="cupo" type="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.cupo" required  autocomplete="cupo" />
                            <InputError class="mt-2" :message="form.errors.cupo" />
                        </div>
                    </div>  
                    <div class="sm:col-span-2">
                        <InputLabel for="activo" value="Estatus" />
                        <div class="mt-2">
                            <select id="activo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.activo" required>
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.activo" />
                        </div>
                    </div>                    
                  </div>
                    <div class="mt-4 flex flex-col items-end">
                        <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Guardar
                        </PrimaryButton>
                    </div>                
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const form = useForm({
    plan_id: '',
   // periodo_id: '',
    docente_id: '',
    modalidad: '',
    cupo: '',
    activo: '',

});
const props = defineProps({
    errors: { type: Object },
    plans: { type: Object },
  //  periodos: { type: Object },
    docentes: { type: Object },
});
</script>