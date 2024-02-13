<template>
    <Head title="Nuevo Período" />

    <AuthenticatedLayout>
        <template #header>
            Crear Período
        </template>
        <div  class="mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200 ">
            <Link :href="route('periodos.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado</Link
            >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.post(route('periodos.store'))" >
                  <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="nombre" value="Período" />
                        <div class="mt-2">
                            <TextInput id="nombre" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.nombre" required autofocus autocomplete="periodo" />
                            <InputError class="mt-2" :message="form.errors.nombre" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="fecha_ini" value="Fecha de Inicio" />
                        <div class="mt-2">
                            <TextInput class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="fecha_ini" type="text" name="fecha_ini" v-model="form.fecha_ini" required autocomplete="fecha_ini" />
                            <div v-if="errors.fecha_ini" class="text-sm text-red-600">{{ errors.fecha_ini }}</div>
                        </div>
                    </div> 
                    <div class="sm:col-span-3">
                        <InputLabel for="fecha_fin" value="Fecha de Finalización" />
                        <div class="mt-2">
                            <TextInput class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="fecha_fin" type="text" name="fecha_fin" v-model="form.fecha_fin" required autocomplete="fecha_fin" />
                            <div v-if="errors.fecha_fin" class="text-sm text-red-600">{{ errors.fecha_fin }}</div>
                        </div>
                    </div>     
                    <div class="sm:col-span-3">
                        <InputLabel for="activo" value="Estado" />
                        <div class="mt-2">
                            <select id="activo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.activo" required>
                                <option value="0">Inactivo</option>
                                <option value="1">activo</option>
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
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import { onMounted } from 'vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    nombre: '',
    fecha_ini: '',
    fecha_fin: '',
    activo: '',

});
const props = defineProps({
    errors: { type: Object },
  
});
onMounted(() => {
  flatpickr('#fecha_ini, #fecha_fin', {
    // Configuración adicional de Flatpickr si es necesario
  });
});

</script>