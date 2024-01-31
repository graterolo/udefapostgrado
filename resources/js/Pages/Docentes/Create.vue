<template>
    <Head title="Nuevo Docente" />

    <AuthenticatedLayout>
        <template #header>
            Crear Docente
        </template>
        <div  class="mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200 ">
            <Link :href="route('docentes.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado</Link
            >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.post(route('docentes.store'))" >
                  <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="cedula" value="Cédula" />
                        <div class="mt-2">
                            <TextInput id="cedula" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.cedula" required autofocus autocomplete="cedula" />
                            <InputError class="mt-2" :message="form.errors.cedula" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="nombre" value="Nombre" />
                        <div class="mt-2">
                            <TextInput id="nombre" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.nombre" required  autocomplete="nombre" />
                            <div v-if="errors.nombre" class="text-sm text-red-600">{{ errors.nombre }}</div>
                            <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                        </div>
                    </div>     
                    <div class="sm:col-span-3">
                        <InputLabel for="sexo" value="Género" />
                        <div class="mt-2">
                            <select id="sexo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.sexo" required>
                                <option value="0">Femenino</option>
                                <option value="1">Masculino</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.sexo" />
                        </div>
                    </div>    
                    <div class="sm:col-span-3">
                        <InputLabel for="direc_hab" value="Direccción" />
                        <div class="mt-2">
                            <TextInput id="direc_hab" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.direc_hab" autocomplete="direc_hab" />
                            <InputError class="mt-2" :message="form.errors.direc_hab" />
                        </div>
                    </div>    
                    <div class="sm:col-span-3">
                        <InputLabel for="edo_hab" value="Estado" />
                        <div class="mt-2">
                            <TextInput id="edo_hab" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.edo_hab" autocomplete="edo_hab" />
                            <InputError class="mt-2" :message="form.errors.edo_hab" />
                        </div>
                    </div>    
                    <div class="sm:col-span-3">
                        <InputLabel for="ciud_hab" value="Ciudad" />
                        <div class="mt-2">
                            <TextInput id="ciud_hab" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.ciud_hab" autocomplete="ciud_hab" />
                            <InputError class="mt-2" :message="form.errors.ciud_hab" />
                        </div>
                    </div>   
                    <div class="sm:col-span-3">
                        <InputLabel for="telefono" value="Teléfono" />
                        <div class="mt-2">
                            <TextInput id="telefono" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.telefono" autocomplete="telefono" />
                            <InputError class="mt-2" :message="form.errors.telefono" />
                        </div>
                    </div> 
                    <div class="sm:col-span-3">
                        <InputLabel for="celular" value="Celular" />
                        <div class="mt-2">
                            <TextInput id="celular" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.celular" autocomplete="celular" />
                            <InputError class="mt-2" :message="form.errors.celular" />
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
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    cedula: '',
    nombre: '',
    sexo: '',
    direc_hab: '',
    edo_hab: '',
    ciud_hab: '',
    telefono: '',
    celular: '',

});
const props = defineProps({
    errors: { type: Object },
})
</script>