<template>
    <Head title="Docente" />

    <AuthenticatedLayout>
        <template #header>
            Datos Personales del Docente
        </template>
        <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end"> 
             <Link v-if="$page.props.auth.user.tipo >= 1" :href="route('docentes.edit', docente.id)" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Editar</Link
                > 

                <Link v-if="$page.props.auth.user.tipo === 2" :href="route('docentes.index')" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Listado</Link
                >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">  
            <div class="mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="cedula" value="Cédula" />
                        <div class="mt-2">
                            <textarea name="cedula" id="cedula" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ docente.cedula }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="nombre" value="Nombre" />
                        <div class="mt-2">
                            <textarea name="nombre" id="nombre" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ docente.nombre }}</textarea>
                        </div>
                    </div>     
                    <div class="sm:col-span-3">
                       <div class="mt-2">
                            <InputLabel for="sexo" value="Género" />
                            <textarea name="sexo" id="sexo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" docente.sexo==0">Femenino</textarea>
                            <textarea name="sexo" id="sexo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-else>Masculino</textarea>
                        </div>
                    </div>    
                    <div class="sm:col-span-3">
                        <InputLabel for="direc_hab" value="Direccción" />
                        <div class="mt-2">
                            <textarea name="direc_hab" id="direc_hab" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ docente.direc_hab }}</textarea>
                        </div>
                    </div>    
                    <div class="sm:col-span-3">
                        <InputLabel for="edo_hab" value="Estado" />
                        <div class="mt-2">
                            <textarea name="edo_hab" id="edo_hab" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ docente.edo_hab }}</textarea>
                        </div>
                    </div>    
                    <div class="sm:col-span-3">
                        <InputLabel for="ciud_hab" value="Ciudad" />
                        <div class="mt-2">
                            <textarea name="ciud_hab" id="ciud_hab" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ docente.ciud_hab }}</textarea>
                        </div>
                    </div>   
                    <div class="sm:col-span-3">
                        <InputLabel for="telefono" value="Teléfono" />
                        <div class="mt-2">
                            <textarea name="telefono" id="telefono" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ docente.telefono }}</textarea>
                        </div>
                    </div> 
                    <div class="sm:col-span-3">
                        <InputLabel for="celular" value="Celular" />
                        <div class="mt-2">
                            <textarea name="celular" id="celular" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ docente.celular }}</textarea>
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


const props = defineProps({ 
    docente: {type:Object}
});

</script>