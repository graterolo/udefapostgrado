<template>
    <Head title="Imprimir Constancia de Estudios" />

    <div class="bg-white min-h-screen text-black p-12 font-sans text-justify">
        <!-- Panel Web de Control -->
        <div class="print:hidden max-w-3xl mx-auto mb-8 flex justify-between items-center bg-indigo-50 p-4 rounded-lg border border-indigo-200">
            <span class="text-sm text-indigo-800 font-medium">Formatos Oficiales de Secretaría General.</span>
            <div class="flex gap-2">
                <Link
                    :href="route('dashboard')"
                    class="px-4 py-2 bg-gray-500 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-gray-600 transition"
                >
                    Volver
                </Link>
                <button
                    @click="window.print()"
                    class="px-4 py-2 bg-indigo-600 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-indigo-700 transition"
                >
                    Imprimir Constancia
                </button>
            </div>
        </div>

        <!-- Contenedor Oficial de Reportes -->
        <ReporteLayout :mostrar-docente="false">
            <div class="max-w-2xl mx-auto mt-12 leading-relaxed text-sm">

                <h1 class="text-center font-bold uppercase text-base tracking-widest mb-16 underline">
                    Constancia de Estudios
                </h1>

                <p class="mb-6">
                    Quien suscribe, de la Dirección de Control de Estudios de la Universidad, hace constar por medio del presente documento que el ciudadano(a):
                    <span class="font-bold uppercase">{{ props.alumno.nombre_completo }}</span>,
                    titular de la cédula de identidad número <span class="font-mono font-bold">{{ props.alumno.cedula }}</span>,
                    se encuentra formalmente inscrito y cursando activamente el programa de postgrado correspondiente a la
                    <span class="font-bold uppercase">“{{ props.maestria }}”</span>.
                </p>

                <p class="mb-6">
                    Se certifica que el mencionado estudiante registra actividades académicas vigentes para el presente
                    <span class="font-bold uppercase">{{ props.periodo.nombre }}</span>, cumpliendo con la carga horaria y los requisitos normativos del programa educativo.
                </p>

                <p class="mb-16">
                    Constancia que se expide a petición de la parte interesada, en la ciudad universitaria, a los
                    <span class="font-medium">{{ props.fecha_emision }}</span>.
                </p>

                <!-- Bloque de Firmas Estructuradas al fondo del documento -->
                <div class="mt-24 grid grid-cols-1 justify-items-center text-center">
                    <div class="w-64 border-t border-black pt-2 text-xs uppercase tracking-wider font-semibold">
                        Control de Estudios<br />
                        Dirección de Secretaría General
                    </div>
                </div>

            </div>
        </ReporteLayout>
    </div>
</template>

<script setup>
import ReporteLayout from '@/Components/ReporteLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    alumno: Object,
    maestria: String,
    periodo: Object,
    fecha_emision: String
});
</script>

<style scoped>
@media print {
    .print\:hidden {
        display: none !important;
    }
    @page {
        size: letter;
        margin: 3cm 2.5cm 3cm 2.5cm; /* Márgenes amplios de carta formal */
    }
}
</style>
