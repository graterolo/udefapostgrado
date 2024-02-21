<template>
    <Head title="Register" />

    <GuestLayout>
        <!-- <Link href="/" class="flex items-center justify-center">
            <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
        </Link> -->
        <div class="flex items-center">
                <img class = "limg" src="/images/logop.jpg"  alt="">
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nombre" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="cedula" value="Cédula" />
                <TextInput id="cedula" type="number" class="mt-1 block w-full" v-model="form.cedula" required autocomplete="cedula" />
                <!-- <InputError class="mt-2" :message="form.errors.cedula" /> -->
                <div v-if="errors.cedula" class="text-sm text-red-600">{{ errors.cedula }}</div>
            </div>

            <div class="mt-3">
                <InputLabel for="tipo" value="Tipo de Usuario" />
                <select id="tipo" class="mt-1 block w-full" v-model="form.tipo" required>
                    <option value="0">Alumno</option>
                    <option value="1">Docente</option>
                </select>
                <InputError class="mt-2" :message="form.errors.tipo" />
            </div>
            
            <div class="mt-3">
                <InputLabel for="email" value="Correo" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-3">
                <InputLabel for="password" value="Password" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-3">
                <InputLabel for="password_confirmation" value="Confirmar Password" />
                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            
            <div class="mt-4 flex flex-col items-end">
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Registrarte
                </PrimaryButton>

                <Link :href="route('login')" class="mt-4 text-sm text-gray-600 underline hover:text-gray-900">
                    Ya registrado?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    cedula: '',
    tipo: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});
const props = defineProps({
  errors: { type: Object }
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
