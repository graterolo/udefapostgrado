<template>
    <Head title="Editar Alumno" />

    <AuthenticatedLayout>
        <template #header>
            Editar Datos Personales del Alumno
        </template>
        
        <div  class="mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200 ">
            <Link v-if="$page.props.auth.user.tipo === 2" :href="route('alumnos.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado</Link
            >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200"> 
            <form @submit.prevent="$event => form.patch(route('alumnos.update', alumno))" >
                <div class="mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <InputLabel for="cedula" value="Cédula" />
                            <TextInput id="cedula" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.cedula" required autocomplete="cedula" readonly />
                            <InputError class="mt-2" :message="form.errors.cedula" />
                        </div>
                    </div>   
                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <InputLabel for="nombre1" value="Primer Nombre" />
                            <TextInput id="nombre1" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.nombre1" required autofocus autocomplete="nombre1" />
                            <InputError class="mt-2" :message="form.errors.nombre1" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <InputLabel for="nombre2" value="Segundo Nombre" />
                            <TextInput id="nombre2" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.nombre2" autocomplete="nombre2" />
                            <InputError class="mt-2" :message="form.errors.nombre2" />
                        </div>
                    </div>    
                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <InputLabel for="apellido1" value="Primer Apellido" />
                            <TextInput id="apellido1" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.apellido1" required autocomplete="apellido1" />
                            <InputError class="mt-2" :message="form.errors.apellido1" />
                        </div>
                    </div>   
                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <InputLabel for="apellido2" value="Segundo Apellido" />
                            <TextInput id="apellido2" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.apellido2" autocomplete="apellido2" />
                            <InputError class="mt-2" :message="form.errors.apellido2" />
                        </div>
                    </div>                    
                    <div class="sm:col-span-3">
                        <div class="mt-2">
                            <InputLabel for="fecha_nac" value="Fecha de Nacimiento" />
                            <TextInput id="fecha_nac" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.fecha_nac" required autocomplete="fecha_nac" />
                            <InputError class="mt-2" :message="form.errors.fecha_nac" />        
                        </div>
                    </div> 
                    <div class="sm:col-span-2">
                        <div class="mt-2">
                            <InputLabel for="sexo" value="Género" />
                            <select id="sexo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.sexo" required>
                                    <option value="0">Femenino</option>
                                    <option value="1">Masculino</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.sexo" />
                        </div>
                    </div> 
                    <div class="sm:col-span-4"> 
                        <div class="mt-2">
                            <InputLabel for="direc_hab" value="Dirección" />
                            <TextInput id="direc_hab" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.direc_hab" required autocomplete="direc_hab" />
                            <InputError class="mt-2" :message="form.errors.direc_hab" />
                        </div>
                    </div>      
                    <div class="sm:col-span-2"> 
                        <div class="mt-2">
                            <InputLabel for="edo_hab" value="Estado" />
                            <TextInput id="edo_hab" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.edo_hab" required autocomplete="edo_hab" />
                            <InputError class="mt-2" :message="form.errors.edo_hab" />
                        </div>
                    </div> 
                    <div class="sm:col-span-2"> 
                        <div class="mt-2">
                            <InputLabel for="ciud_hab" value="Ciudad" />
                            <TextInput id="ciud_hab" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.ciud_hab" required autocomplete="ciud_hab" />
                            <InputError class="mt-2" :message="form.errors.ciud_hab" />
                        </div>
                    </div> 
                    <div class="sm:col-span-2">    
                        <div class="mt-2">
                            <InputLabel for="telefono" value="Teléfono" />
                            <TextInput id="telefono" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.telefono" required autocomplete="telefono" />
                            <InputError class="mt-2" :message="form.errors.telefono" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">   
                        <div class="mt-2">
                            <InputLabel for="celular" value="Celular" />
                            <TextInput id="celular" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.celular" autocomplete="celular" />
                            <InputError class="mt-2" :message="form.errors.celular" />
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <div class="mt-2">
                            <InputLabel for="titulo" value="Título" />
                            <TextInput id="celular" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.titulo" required autocomplete="titulo" />
                            <InputError class="mt-2" :message="form.errors.titulo" />
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
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { onMounted } from 'vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ 
    errors: { type: Object },
    alumno: {type:Object}
    
});
const form = useForm({
    cedula: props.alumno.cedula,
    nombre1: props.alumno.nombre1,
    nombre2: props.alumno.nombre2,
    apellido1: props.alumno.apellido1,
    apellido2: props.alumno.apellido2,
    fecha_nac: props.alumno.fecha_nac,
    sexo: props.alumno.sexo,
    direc_hab: props.alumno.direc_hab,
    edo_hab: props.alumno.edo_hab,
    ciud_hab: props.alumno.ciud_hab,
    telefono: props.alumno.telefono,
    celular: props.alumno.celular,
    titulo: props.alumno.titulo,
});
onMounted(() => {
  flatpickr('#fecha_nac', {
    // Configuración adicional de Flatpickr si es necesario
  });
});
</script>