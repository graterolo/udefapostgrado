<template>
    <Head title="Editar Master o Postgrado" />

    <AuthenticatedLayout>
        <template #header>
            Editar Master o Postgrado
        </template>
        <div  class="overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end">
            <Link :href="route('masters.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado</Link
            >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.patch(route('masters.update', master))" >
                  <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <InputLabel for="siglas" value="Siglas" />
                        <div class="mt-2">
                            <TextInput id="siglas" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.siglas" required autofocus autocomplete="siglas" />
                            <InputError class="mt-2" :message="form.errors.siglas" />
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <InputLabel for="nombre" value="Maestría/Postg." />
                        <div class="mt-2">
                            <TextInput id="nombre" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.nombre" required  autocomplete="nombre" />
                            <div v-if="errors.nombre" class="text-sm text-red-600">{{ errors.nombre }}</div>
                            <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                        </div>
                    </div>     
                    <div class="sm:col-span-2">
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
            <div  class="overflow-hidden mt-2 sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end">
              <DangerButton @click="$event => deleteMaster(master.id)">
                    Eliminar
              </DangerButton>                       
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({ 
    errors: { type: Object },
    master: {type:Object}
    
});
const form = useForm({
    siglas: props.master.siglas,
    nombre: props.master.nombre,
    activo: props.master.activo,
    
});
const deleteMaster = (id) => {
  if (confirm('Está seguro de eliminar esta maestría o postgrado?')) {
    form.delete(route('masters.destroy', id));
  }
}
</script>