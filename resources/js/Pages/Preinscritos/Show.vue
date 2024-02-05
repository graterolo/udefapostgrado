<template>
    <Head title="Preinscrito" />

    <AuthenticatedLayout>
        <template #header>
            Preinscripción del Alumno
        </template>
        <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end">      

                  <Link v-if="$page.props.auth.user.tipo === 2" :href="route('preinscritos.edit', preinscrito.id)" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Editar</Link
                >  

                <Link v-if="$page.props.auth.user.tipo === 2" :href="route('preinscritos.index')" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Listado</Link
                >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">  
            <div class="mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-2">
                    <div class="mt-2">
                        <InputLabel for="cedula" value="Cédula" />
                        <textarea name="cedula" id="cedula" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ preinscrito.cedula }}</textarea>
                    </div>
                </div>  
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <InputLabel for="nombre" value="Nombre" />
                        <textarea name="nombre" id="nombre" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ preinscrito.nombre1 }} {{ preinscrito.apellido1 }}</textarea>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <InputLabel for="postg" value="Postgrado/Maestría" />
                        <textarea name="postg" id="postg" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ preinscrito.nombre }}</textarea>
                    </div>
                </div>    
                <div class="sm:col-span-2">
                    <div class="mt-2">
                        <InputLabel for="fecha" value="Fecha de Registro" />
                        <textarea
                            v-model="formattedDate"
                            name="fecha"
                            id="fecha"
                            rows="1"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            readonly
                        ></textarea>           
                        <!-- <textarea name="fecha" id="fecha" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ preinscrito.updated_at }}</textarea> -->
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
    preinscrito: {type:Object}
});
const formattedDate = computed(() => new Date(props.preinscrito.updated_at).toLocaleDateString());

</script>