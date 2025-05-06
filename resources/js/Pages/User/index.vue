<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import UserLayouts from './Layouts/UserLayouts.vue';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

//product list
defineProps({
    products:Array
})
</script>

<template>
    <UserLayouts>
        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest Product List</h2>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <div v-for="product in products" :key="product.id" class="group relative">
                        <img v-if="product.product_images.length > 0" :src="`/${product.product_images[0].image}`" :alt="product.imageAlt"
                            class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                            <img v-else src="data:image/png;base64,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" :alt="product.imageAlt"
                            class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a :href="product.href">
                                        <span aria-hidden="true" class="absolute inset-0" />
                                        {{ product.title }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ product.brand.name }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">{{ product.price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </UserLayouts>

</template>