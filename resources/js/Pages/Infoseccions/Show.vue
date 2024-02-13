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
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ 
    infoseccion: {type:Object},

});
const formattedDate = computed(() => new Date(props.infoseccion.updated_at).toLocaleDateString());
</script>