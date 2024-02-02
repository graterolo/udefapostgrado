<template>
    <Head title="Alumno" />

    <AuthenticatedLayout>
        <template #header>
            Datos Personales del Alumno
        </template>
        <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end">      

                 <Link :href="route('alumnos.edit', alumno.id)" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Editar</Link
                > 

                <Link v-if="$page.props.auth.user.tipo === 2" :href="route('alumnos.index')" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Listado</Link
                >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">  
            <div class="mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <div class="mt-2">
                        <InputLabel for="cedula" value="Cédula" />
                        <textarea name="cedula" id="cedula" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.cedula }}</textarea>
                    </div>
                </div>  
                <div class="sm:col-span-3">
                    <div class="mt-2">
                        <InputLabel for="nombre1" value="Primer Nombre" />
                        <textarea name="nombre1" id="nombre1" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.nombre1 }}</textarea>
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <div class="mt-2">
                        <InputLabel for="nombre2" value="Segundo Nombre" />
                        <textarea name="nombre2" id="nombre2" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.nombre2 }}</textarea>
                    </div>
                </div>    
                <div class="sm:col-span-3">
                    <div class="mt-2">
                        <InputLabel for="apellido1" value="Primer Apellido" />
                        <textarea name="apellido1" id="apellido1" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.apellido1 }}</textarea>
                    </div>
                </div>   
                <div class="sm:col-span-3">
                    <div class="mt-2">
                        <InputLabel for="apellido2" value="Segundo Apellido" />
                        <textarea name="apellido2" id="apellido2" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.apellido2 }}</textarea>
                    </div>
                </div>                    
                <div class="sm:col-span-3">
                    <div class="mt-2">
                        <InputLabel for="fecha" value="Fecha de Nacimiento" />
                        <textarea
                            v-model="formattedDate"
                            name="fecha"
                            id="fecha"
                            rows="1"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            readonly
                        ></textarea>  
                        <!-- <textarea name="apellido2" id="apellido2" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.fecha_nac }}</textarea>         -->
                    </div>
                </div> 
                <div class="sm:col-span-2">
                    <div class="mt-2">
                        <InputLabel for="sexo" value="Género" />
                        <textarea name="sexo" id="sexo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" alumno.sexo==0">Femenino</textarea>
                        <textarea name="sexo" id="sexo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-else>Masculino</textarea>
                    </div>
                </div> 
                <div class="sm:col-span-4"> 
                    <div class="mt-2">
                        <InputLabel for="direc_hab" value="Dirección" />
                        <textarea name="direc_hab" id="direc_hab" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.direc_hab }}</textarea>
                    </div>
                </div>      
                <div class="sm:col-span-2"> 
                    <div class="mt-2">
                        <InputLabel for="edo_hab" value="Estado" />
                        <textarea name="edo_hab" id="edo_hab" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.edo_hab }}</textarea>
                    </div>
                </div> 
                <div class="sm:col-span-2"> 
                    <div class="mt-2">
                        <InputLabel for="ciud_hab" value="Ciudad" />
                        <textarea name="ciud_hab" id="ciud_hab" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.ciud_hab }}</textarea>
                    </div>
                </div> 
                <div class="sm:col-span-2">    
                    <div class="mt-2">
                        <InputLabel for="telefono" value="Teléfono" />
                        <textarea name="telefono" id="telefono" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.telefono }}</textarea>
                    </div>
                </div>
                <div class="sm:col-span-2">   
                    <div class="mt-2">
                        <InputLabel for="celular" value="Celular" />
                        <textarea name="celular" id="celular" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.celular }}</textarea>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <InputLabel for="titulo" value="Título" />
                        <textarea name="titulo" id="titulo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ alumno.titulo }}</textarea>
                    </div>
                </div>            
            </div>
          </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ 
    alumno: {type:Object}
});
const formattedDate = computed(() => new Date(props.alumno.fecha_nac).toLocaleDateString());
</script>