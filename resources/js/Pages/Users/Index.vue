<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            Usuarios
        </template>

        <div class="flex items-center justify-between mb-6">            
               <input v-model="searchTerm" type="text" class="w-2/4 mt-4 p-2 border border-gray-300 rounded-md" placeholder="Buscar usuario...">
                    <Link :href="route('users.create')" 
                        class="px-1 py-1 bg-indigo-500 text-white border rounded-md "
                        >Nuevo
                    </Link>            
        </div>  
        
        <div class="bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            #
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Email
                        </th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="user in filteredUsers" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('users.show', user.id)">
                               {{ user.id }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('users.show', user.id)">
                                {{ user.name }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link class="flex items-center px-5 py-3 focus:text-indigo-500 text-sm" :href="route('users.show', user.id)">
                               {{ user.email }}
                            </Link>
                        </td>
                    </tr>
                </tbody>        
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="users.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head, Link } from '@inertiajs/vue3';
import { computed, defineProps, ref } from 'vue';

const props = defineProps({
    users: Object
});
const searchTerm = ref('');

const filteredUsers = computed(() => {
    const searchTermLowerCase = searchTerm.value.toLowerCase();
    return props.users.data.filter(doc => {
        return doc.name.toLowerCase().includes(searchTermLowerCase) ||
               doc.email.includes(searchTermLowerCase);
    });
});
</script>
