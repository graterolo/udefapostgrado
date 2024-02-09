<template>
    <Head title="Plan de Estudio" />

    <AuthenticatedLayout>
        <template #header>
            Plan de Estudio
        </template>
         <div  class="overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end">
            <Link v-if="$page.props.auth.user.tipo === 2" :href="route('plans.edit', plan.id)" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Editar
            </Link>
            <Link :href="route('plans.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado
            </Link>            
        </div> 

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                
                  <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="master_id" value="Mastría o Postgrado" />
                        <div class="mt-2">
                          <textarea name="master_id" id="master_id" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.mnombre }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <InputLabel for="codigo" value="Código" />
                        <div class="mt-2">
                            <textarea name="codigo" id="codigo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.codigo }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="nombre" value="Materia" />
                        <div class="mt-2">
                            <textarea name="nombre" id="nombre" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.nombre }}</textarea>
                        </div>
                    </div>     
                    <div class="sm:col-span-2">
                        <InputLabel for="prelacion1" value="Prelación 1" />
                        <div class="mt-2">
                            <textarea name="prelacion1" id="prelacion1" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.prelacion1 }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <InputLabel for="prelacion2" value="Prelación 2" />
                        <div class="mt-2">
                            <textarea name="prelacion2" id="prelacion2" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.prelacion2 }}</textarea>
                        </div>
                    </div>  
                    <div class="sm:col-span-1">
                        <InputLabel for="semestre" value="Semestre" />
                        <div class="mt-2">
                            <textarea name="semestre" id="semestre" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.semestre }}</textarea>
                        </div>
                    </div>  
                    <div class="sm:col-span-1">
                        <InputLabel for="uc" value="UC" />
                        <div class="mt-2">
                            <textarea name="uc" id="uc" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.uc }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <InputLabel for="horast" value="Horas T." />
                        <div class="mt-2">
                            <textarea name="horast" id="horast" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.horast }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <InputLabel for="horasp" value="Horas P." />
                        <div class="mt-2">
                            <textarea name="horasp" id="horasp" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.horasp }}</textarea>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                      <div class="mt-2">
                        <InputLabel for="updated_at" value="Ultima Actualizacion" />
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
                            <textarea name="updated_by" id="updated_by" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ plan.name }}</textarea>
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
    plan: {type:Object}
});
const formattedDate = computed(() => new Date(props.plan.updated_at).toLocaleDateString());
</script>