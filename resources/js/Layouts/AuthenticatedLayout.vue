<template>
    <div class="flex h-screen bg-gray-200 font-roboto">
        <Navigation />

        <div class="flex flex-1 flex-col overflow-hidden">
            <Header />

            <main class="flex-1 overflow-y-auto overflow-x-hidden bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                    <h3 class="mb-4 text-3xl font-medium text-gray-700">
                        <slot name="header" />
                    </h3>

                    <div v-if="$page.props.flash.message" class=" alert mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
                        <div class="flex w-12 items-center justify-center bg-blue-800">
                            <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                            </svg>
                        </div>
                
                        <div class="-mx-3 px-4 py-2">
                            <div class="mx-3">
                                <span class="font-semibold text-blue-800">Msj</span>
                                <p class="text-sm text-gray-600">{{ $page.props.flash.message }}</p>
                            </div>
                        </div>
                    </div> 

                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import Header from '@/Layouts/Header.vue';
import Navigation from '@/Layouts/Navigation.vue';
</script>
