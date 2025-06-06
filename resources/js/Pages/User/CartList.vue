<script setup>
import UserLayouts from './Layouts/UserLayouts.vue';
import { computed, reactive } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const carts = computed(() => usePage().props.cart.data.items);
const products = computed(() => usePage().props.cart.data.products);
const total = computed(() => usePage().props.cart.data.total);
const itemId = (id) => carts.value.findIndex((item) => item.product_id === id);

const form = reactive({
    address1: null,
    state: null,
    city:null,
    zipcode:null,
    city_code:null,
    type: null
})

const update = (product,quantity) => router.patch(route('cart.update', product), {
    quantity
})

//remove from the cart
const remove = (product) => router.delete(route('cart.delete',product))

defineProps({
    userAddress: Object
})

function submit(){
    router.visit(route('checkout.store'),{
        method: 'post',
        data:{
            carts:usePage().props.cart.data.items,
            products:usePage().props.cart.data.products,
            total:usePage().props.cart.data.total,
            address:form
        }
    })
}

const formFilled = computed(() => {
  return (
    form.address1 !== null &&
    form.state !== null &&
    form.city !== null &&
    form.zipcode !== null &&
    form.country_code !== null &&
    form.type !== null
  );
});

</script>

<template>
    <UserLayouts>
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
                <div class="lg:w-2/3 md:w-1/2 rounded-lg  sm:mr-10 p-10 ">
                    <!--list of cart items-->

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-16 py-3">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Qty
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" :key="product.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <img v-if="product.product_images.length > 0"
                                        :src="`/${product.product_images[0].image}`"
                                        class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
                                    <img v-else
                                        src="data: image / png; base64, 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"
                                        class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ product.title }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <button @click.prevent="update(product, carts[itemId(product.id)].quantity - 1 )"
                                        :disabled="carts[itemId(product.id)].quantity <= 1"
                                        :class="[carts[itemId(product.id)].quantity > 1? 'cursor-pointer text-purple-600':'cursor-not-allowed dark:text-gray-500','inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700']"
                                            class=""
                                            type="button">
                                            <span class="sr-only">Quantity button</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                        <div>
                                            <input type="number" id="first_product" v-model="carts[itemId(product.id)].quantity"
                                                class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="1" required />
                                        </div>
                                        <button @click.prevent="update(product, carts[itemId(product.id)].quantity + 1 )"
                                            class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                            type="button">
                                            <span class="sr-only">Quantity button</span>
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ product.price }}
                                </td>
                                <td class="px-6 py-4">
                                    <a @click="remove(product)"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">Remove</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>


                </div>
                <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Summary</h2>
                    <p class="leading-relaxed mb-5 text-gray-600">Total:ksh {{total}}</p>

                    <div v-if="userAddress">
                        <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Shipping Address</h2>
                    <p class="leading-relaxed mb-5 text-gray-600">{{userAddress.address1}},{{userAddress.city}},{{userAddress.zipcode}}</p>

                    </div>

                    <div v-else>
                        <p class="leading-relaxed mb-5 text-gray-600">Add shipping address to continue</p>
                    </div>


                    <form @submit.prevent="submit" action="">
                        <div class="relative mb-4">
                        <label for="address1" class="leading-7 text-sm text-gray-600">Address 1</label>
                        <input type="text" id="city" name="address1" v-model="form.address1"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="name" class="leading-7 text-sm text-gray-600">City</label>
                        <input type="text" id="city" name="city" v-model="form.city"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="name" class="leading-7 text-sm text-gray-600">State</label>
                        <input type="text" id="state" name="state" v-model="form.state"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="zipCode" class="leading-7 text-sm text-gray-600">Zip Code</label>
                        <input type="text" id="name" name="zipcode" v-model="form.zipcode"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="countryCode" class="leading-7 text-sm text-gray-600">Country Code</label>
                        <input type="text" id="countryCode" name="countrycode" v-model="form.country_code"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="type" class="leading-7 text-sm text-gray-600">Address type</label>
                        <input type="type" id="type" name="type" v-model="form.type"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button v-if="formFilled || userAddress" type="submit"
                        class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Checkout</button>

                    <button v-else type="submit"
                        class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Add Addredss to continue</button>

                    </form>
                </div>
            </div>
        </section>
    </UserLayouts>
</template>