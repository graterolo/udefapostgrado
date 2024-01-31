<template>
    <Head title=" Usuario" />

    <AuthenticatedLayout>
        <template #header>
             Usuario
        </template>
        <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end">
                <Link :href="route('users.edit', user.id)" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Editar</Link
                >

                <Link :href="route('users.index')" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Listado</Link
                >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <div class="mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <InputLabel for="name" value="Nombre" />
                      <div class="mt-2">
                        <textarea name="name" id="name" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ user.name }}</textarea>   
                      </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="cedula" value="Cédula de Usuario" />
                        <div class="mt-2">
                            <textarea name="cedula" id="cedula" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ user.cedula }}</textarea>
                        </div>    
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="tipo" value="Tipo de usuario" />
                        <div class="mt-2">
                            <textarea name="tipo" id="tipo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" user.tipo==1">Docente</textarea>
                            <textarea name="tipo" id="tipo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" user.tipo==2">Administrador</textarea>
                        </div>
                    </div>   
                    <div class="sm:col-span-3">
                        <InputLabel for="email" value="Email" />
                        <div class="mt-2">
                            <textarea name="email" id="email" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ user.email }}</textarea>
                        </div>
                    </div>
                     
                    <!-- <div class="sm:col-span-3">
                        <InputLabel for="activo" value="Activo?" />
                        <div class="mt-2">
                            <textarea name="activo" id="activo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" user.activo==1">Si</textarea>
                            <textarea name="activo" id="activo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-else>No</textarea>
                        </div>
                    </div>     -->
                </div>                 
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


const props = defineProps({ 
    user: {type:Object}
});
const form = useForm({
    id:''
});


</script>