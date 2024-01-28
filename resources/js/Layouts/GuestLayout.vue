<template>
        <!-- Mensaje de error para páginas Guest -->
      <!-- <div v-if="$page.props.errors" class="alert mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
      <div class="flex w-12 items-center justify-center bg-red-500">
        <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
          <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
        </svg>
      </div>

      <div class="-mx-3 px-4 py-2">
        <div class="mx-3">
          <span class="font-semibold text-red-500">Error</span>
          <p class="text-sm text-gray-600">{{ $page.props.errors }}</p>
        </div>
      </div>
    </div> -->

    <div class="flex h-screen items-center justify-center bg-gray-200 px-6">
    
        <div class="w-full max-w-sm rounded-md bg-white p-6 shadow-md">
            <slot />
        </div>
    </div>
</template>
<script setup>

// const props = defineProps({
//   errors: { type: Object } 
// });
</script>
