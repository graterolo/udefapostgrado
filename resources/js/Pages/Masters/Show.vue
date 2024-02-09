<template>
  <div>
    <Head title="Maestría o Postgrado" />

    <AuthenticatedLayout>
        <template #header>
            Maestría o Postgrado
        </template>
        <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end">      

                <Link v-if="$page.props.auth.user.tipo === 2" :href="route('masters.edit', master.id)" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Editar</Link
                >  

                <Link v-if="$page.props.auth.user.tipo === 2" :href="route('masters.index')" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >Listado</Link
                >            
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 border-b border-gray-200">  
            <div class="mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-2">
                    <div class="mt-2">
                        <InputLabel for="siglas" value="Siglas" />
                        <textarea name="siglas" id="siglas" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ master.siglas }}</textarea>
                    </div>
                </div>  
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <InputLabel for="nombre" value="Maestría/Postg." />
                        <textarea name="nombre" id="nombre" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ master.nombre }}</textarea>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <div class="mt-2">
                        <InputLabel for="activo" value="Estatus" />
                        <textarea name="activo" id="activo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-if=" master.activo==0">Inactivo</textarea>
                        <textarea name="activo" id="activo" rows="1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-else>Activo</textarea>
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
                    </div>
                </div>   
                     
            </div>
          </div>
        </div>
        <div class=" justify-between flex flex-row space-x-2 mb-2 ">
            <div class="mt-10 text-2xl  text-gray-900 shadow-sm ">Plan Académico</div>
              <div class="mt-10 ml-10 overflow-hidden shadow-sm sm:rounded-lg  ">
                <Link v-if="$page.props.auth.user.tipo === 2" :href="route('plans.create')" 
                    class="inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >Agregar +</Link> 
              </div>
        </div>
        <div class="mt-6 bg-white rounded shadow overflow-x-auto">
         
      <table class="w-full whitespace-nowrap">
        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
          <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Sem.</th>
          <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Código</th>
          <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Materia</th>
          <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Hrs T.</th>
          <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Hrs P.</th>
          <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">UC</th>
          <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Prel.</th>
        </tr>
        <tr v-for="plan in plans" :key="plan.pid" class="hover:bg-gray-100 focus-within:bg-gray-100">
        <td class="border-t">
          <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.pid)">
              {{ plan.semestre }}
          </Link>
        </td>
        <td class="border-t">
          <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.pid)">
             {{ plan.codigo }}
          </Link>
        </td>
        <td class="border-t">
          <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.pid)">
             {{ plan.nombre }}
          </Link>
        </td>
        <td class="border-t">
          <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.pid)">
            {{ plan.horast }}
          </Link>
        </td>
        <td class="border-t">
          <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.pid)">
            {{ plan.horasp }}
          </Link>
        </td>
        <td class="border-t">
          <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.pid)">
            {{ plan.uc }}
          </Link>
        </td>
        <td class="border-t">
          <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('plans.show', plan.pid)">
            {{ plan.prelacion1 }}
          </Link>
        </td>
      </tr>
      <tr v-if="plans.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No plans found.</td>
      </tr>
      </table>
    </div>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputLabel from '@/Components/InputLabel.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({ 
    master: {type:Object},
    plans: {type:Object}

});

const formattedDate = computed(() => new Date(props.master.updated_at).toLocaleDateString());

</script>