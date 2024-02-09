<template>
    <Head title="Agregar Plan de Estudio" />

    <AuthenticatedLayout>
        <template #header>
            Agregar Plan de Estudio
        </template>
        <!-- <div  class="mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200 ">
            <Link :href="route('masters.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado</Link
            >            
        </div> -->

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.post(route('plans.store'))" >
                  <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <InputLabel for="master_id" value="Mastría o Postgrado" />
                        <div class="mt-2">
                            <SelectInput id="master_id" :options="masters" type="text" v-model="form.master_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required autofocus>
                            </SelectInput>
                            <InputError class="mt-2" :message="form.errors.master_id" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <InputLabel for="codigo" value="Código" />
                        <div class="mt-2">
                            <TextInput id="codigo" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.codigo" required autocomplete="codigo" />
                            <InputError class="mt-2" :message="form.errors.codigo" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="nombre" value="Materia" />
                        <div class="mt-2">
                            <TextInput id="nombre" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.nombre" required  autocomplete="nombre" />
                            <InputError class="mt-2" :message="form.errors.nombre" />
                        </div>
                    </div>     
                    <div class="sm:col-span-2">
                        <InputLabel for="prelacion1" value="Prelación 1" />
                        <div class="mt-2">
                            <TextInput id="prelacion1" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.prelacion1"  autocomplete="prelacion1" />
                            <InputError class="mt-2" :message="form.errors.prelacion1" />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <InputLabel for="prelacion2" value="Prelación 2" />
                        <div class="mt-2">
                            <TextInput id="prelacion2" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.prelacion2"  autocomplete="prelacion2" />
                            <InputError class="mt-2" :message="form.errors.prelacion2" />
                        </div>
                    </div>  
                    <div class="sm:col-span-1">
                        <InputLabel for="semestre" value="Semestre" />
                        <div class="mt-2">
                            <TextInput id="semestre" type="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.semestre" required  autocomplete="semestre" />
                            <InputError class="mt-2" :message="form.errors.semestre" />
                        </div>
                    </div>  
                    <div class="sm:col-span-1">
                        <InputLabel for="uc" value="UC" />
                        <div class="mt-2">
                            <TextInput id="uc" type="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.uc" required  autocomplete="uc" />
                            <InputError class="mt-2" :message="form.errors.uc" />
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <InputLabel for="horast" value="Horas T." />
                        <div class="mt-2">
                            <TextInput id="horast" type="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.horast" autocomplete="horast" />
                            <InputError class="mt-2" :message="form.errors.horast" />
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <InputLabel for="horasp" value="Horas P." />
                        <div class="mt-2">
                            <TextInput id="horasp" type="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.horasp" autocomplete="horasp" />
                            <InputError class="mt-2" :message="form.errors.horasp" />
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
import SelectInput from '@/Components/SelectInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    master_id: '',
    codigo: '',
    nombre: '',
    prelacion1: '',
    prelacion2: '',
    semestre: '',
    uc: '',
    horast: '',
    horasp: '',

});
const props = defineProps({
    errors: { type: Object },
    masters: { type: Object },
})
</script>