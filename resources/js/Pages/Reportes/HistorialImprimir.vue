<template>
    <Head title="Historial Académico" />

    <div class="bg-white min-h-screen text-black p-6 font-sans">

        <!-- Botón flotante web (Se oculta al imprimir) -->
        <div class="print:hidden max-w-4xl mx-auto mb-6 flex justify-between items-center bg-indigo-50 p-4 rounded-lg border border-indigo-200">
            <span class="text-sm text-indigo-800 font-medium">
                Vista previa del Historial Académico Oficial. Verifique los datos antes de imprimir.
            </span>
            <div v-if="props.todas_maestrias.length > 1" class="flex items-center gap-2 bg-white p-1 rounded border">
                <label class="text-xs font-bold text-gray-600 uppercase px-2">Programa Académico:</label>
                <select
                    v-model="maestriaActiva"
                    @change="cambiarMaestria"
                    class="text-xs rounded border-gray-300 p-1"
                >
                    <option v-for="m in props.todas_maestrias" :key="m.id" :value="m.id">
                        {{ m.nombre }}
                    </option>
                </select>
            </div>
            <div class="flex gap-2">
                <Link
                    :href="route('admin.reportes.buscar-historial')"
                    class="px-4 py-2 bg-gray-500 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-gray-600 transition"
                >
                    Volver
                </Link>
                <button
                    @click="ejecutarImpresion"
                    class="px-4 py-2 bg-indigo-600 text-white font-bold text-xs uppercase tracking-wider rounded shadow hover:bg-indigo-700 transition"
                >
                    Imprimir Documento
                </button>
            </div>
        </div>

        <!-- Contenedor del Formato Institucional utilizando tu ReporteLayout modificado -->
        <ReporteLayout :mostrar-docente="false">

            <!-- Ficha técnica del Alumno -->
            <div class="mb-6 grid grid-cols-2 gap-x-4 gap-y-2 text-xs uppercase tracking-wide border border-gray-300 p-4 rounded bg-gray-50 print:bg-transparent print:border-none print:p-0">
                <p><b>Estudiante:</b> {{ props.alumno.nombre_completo }}</p>
                <p><b>Cédula de Identidad:</b> <span class="font-mono">{{ props.alumno.cedula }}</span></p>
                <p><b>Tipo de Documento:</b> Historial Académico</p>
                <p><b>Maestría/Postgrado:</b><span class="font-mono">{{ props.maestria }}</span></p>
            </div>

            <h2 class="text-center font-bold uppercase text-sm tracking-widest mb-6 underline">
                Registro Histórico de Calificaciones
            </h2>

            <!-- Tabla de Calificaciones Históricas -->
            <table class="w-full border-collapse border border-gray-400 text-xs text-left">
                <thead>
                    <tr class="bg-gray-100 print:bg-transparent border-b border-gray-400">
                        <th class="border border-gray-400 px-4 py-2 text-center w-12">N°</th>
                        <th class="border border-gray-400 px-4 py-2 w-32">Período</th>
                        <th class="border border-gray-400 px-4 py-2">Asignatura / Materia</th>
                        <th class="border border-gray-400 px-4 py-2 text-center w-16">U.C.</th>
                        <th class="border border-gray-400 px-4 py-2 text-center w-20">Sección</th>
                        <th class="border border-gray-400 px-4 py-2 text-center w-24">Calificación</th>
                        <th class="border border-gray-400 px-4 py-2 text-center w-28">Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in calificaciones" :key="index" class="border-b border-gray-400">
                        <td class="border border-gray-400 px-4 py-2 text-center">{{ index + 1 }}</td>
                        <td class="border border-gray-400 px-4 py-2 font-semibold text-gray-700 uppercase">{{ item.nombre_periodo }}</td>
                        <td class="border border-gray-400 px-4 py-2 uppercase font-medium">{{ item.nombre_materia }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center font-mono">{{ item.uc }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center uppercase">{{ item.nombre_seccion }}</td>
                        <td class="border border-gray-400 px-4 py-2 text-center font-bold">
                            {{ item.nota_final !== null ? item.nota_final + ' pts' : 'S/N' }}
                        </td>
                        <td class="border border-gray-400 px-4 py-2 text-center uppercase font-bold text-[10px]"
                            :class="item.nota_final !== null && item.nota_final > 9 ? 'text-green-700' : 'text-red-700'">
                            {{ item.nota_final === null ? 'Pendiente' : (item.nota_final > 9 ? 'Aprobado' : 'Reprobado') }}
                        </td>
                    </tr>
                    <tr v-if="calificaciones.length === 0">
                        <td colspan="7" class="border border-gray-400 px-4 py-8 text-center text-gray-400 italic">
                            El estudiante no posee asignaturas registradas en su historial.
                        </td>
                    </tr>
                </tbody>
            </table>
        </ReporteLayout>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import ReporteLayout from '@/Components/ReporteLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    alumno: Object,
    maestria: String,
    maestria_id: Number,
    todas_maestrias: Array,
    calificaciones: Array
});

const maestriaActiva = ref(props.maestria_id);

const cambiarMaestria = () => {
    router.get(
        route('admin.reportes.imprimir-historial', { cedula: props.alumno.cedula }),
        { master_id: maestriaActiva.value },
        { preserveState: true }
    );
};

const ejecutarImpresion = () => {
    window.print();
};

</script>

<style scoped>
@media print {
    .print\:hidden {
        display: none !important;
    }
    table {
        width: 100% !important;
        border-collapse: collapse !important;
        page-break-inside: auto !important;
    }
    thead {
        display: table-header-group !important;
    }
    tr {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    @page {
        size: letter;
        margin: 2cm 1.5cm 2.5cm 1.5cm;
    }
}
</style>
