<template>
    <Head title="Editar Usuario" />

    <AuthenticatedLayout>
        <template #header>
            Editar Usuario
        </template>
        <div  class="mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200 ">
            <Link :href="route('users.index')" 
                class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                >Listado</Link
            >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="$event => form.patch(route('users.update', user))" >
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"> 
                    <div class="sm:col-span-3">
                       <InputLabel for="name" value="Nombre" />
                       <div class="mt-2"> 
                            <TextInput id="name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.name" required autofocus autocomplete="name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                      </div>  
                    <div class="sm:col-span-3">
                      <div class="mt-2">  
                        <InputLabel for="cedula" value="Cédula del Usuario" />
                        <TextInput id="cedula" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.cedula" required  autocomplete="cedula" />
                        <div v-if="errors.cedula" class="text-sm text-red-600">{{ errors.cedula }}</div>
                        <!-- <InputError class="mt-2" :message="form.errors.username" /> -->
                      </div>  
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="tipo" value="Tipo de Usuario" />
                        <div class="mt-2">
                            <select id="tipo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.tipo" required>
                                <option value="1">Docente</option>
                                <option value="2">Administrador</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.tipo" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <InputLabel for="email" value="Email" />
                        <div class="mt-2">  
                            <TextInput id="email" type="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.email" required autocomplete="email" />
                            <div v-if="errors.email" class="text-sm text-red-600">{{ errors.email }}</div>
                            <!-- <InputError class="mt-2" :message="form.errors.email" /> -->
                        </div>    
                    </div>
                    
                    <!-- <div class="sm:col-span-3">
                        <InputLabel for="activo" value="Activo?" />
                        <div class="mt-2">
                            <select id="activo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="form.activo" required>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.activo" />
                        </div>    
                    </div> -->
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


const props = defineProps({ 
    errors: { type: Object },
    user: {type:Object}
    
});
const form = useForm({
    name: props.user.name,
    cedula: props.user.cedula,
    tipo: props.user.tipo,
    email: props.user.email,
});

</script>