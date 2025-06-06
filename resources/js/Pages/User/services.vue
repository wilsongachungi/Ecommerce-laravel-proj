<script setup>
import UserLayouts from './Layouts/UserLayouts.vue';
</script>

<template>
    <UserLayouts>
        <section class="bg-white pb-12 mt-5">
            <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
                <div class="container mx-auto px-6 p-6 bg-white">

                    <div class="mb-16 text-center">
                        <h4 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Our Products</h4>
                        <p class="mt-2 text-5xl lg:text-7xl font-bold tracking-tight text-gray-900">
                            Quality products that meet your needs
                        </p>
                    </div>

                    <div class="flex flex-wrap -mx-4">

                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b md:border-r">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <path d="M12 2L2 7v7c0 5 10 9 10 9s10-4 10-9V7l-10-5z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Smartphones</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Latest models with cutting-edge technology, vibrant displays, and long-lasting battery
                                life.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b md:border-r">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <path d="M5 3h14l-1 14H6L5 3z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Laptops</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Powerful and portable laptops ideal for work, gaming, and creative projects.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <circle cx="12" cy="12" r="10" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Accessories</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Quality headphones, chargers, cases, and more to enhance your tech experience.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b md:border-r md:border-b-0">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <path d="M20 6H4l1 12h14l1-12z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Smartwatches</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Stay connected on the go with smartwatches offering health tracking and notifications.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b md:border-b-0 lg:border-r">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <path d="M7 2v20l10-10L7 2z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Tablets</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Portable tablets with stunning displays perfect for entertainment and work.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <path d="M3 3h18v2H3zM3 19h18v2H3zM6 6h12v12H6z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Gaming Consoles</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                High-performance gaming consoles offering immersive gameplay and entertainment.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b md:border-r lg:border-b-0">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <path d="M12 4a8 8 0 108 8 8 8 0 00-8-8z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Cameras</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Capture every moment with high-resolution cameras and professional lenses.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b lg:border-b-0">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <path d="M6 3h12v18H6z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Home Appliances</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Essential home appliances combining technology and efficiency for everyday use.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <!-- Books -->
                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b lg:border-b-0">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                    fill="currentColor" class="h-6 w-6 text-indigo-500">
                                    <path d="M4 4h16v16H4z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Books & Novels</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                From captivating novels to inspiring self-help books, we have something for every
                                reader.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <!-- Clothing -->
                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b lg:border-b-0">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="h-6 w-6 text-indigo-500" viewBox="0 0 24 24">
                                    <path d="M4 3h16l-1 9H5L4 3zM5 13h14v8H5z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Clothing</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Trendy and comfortable outfits for students and professionals alike, perfect for campus
                                life.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <!-- Shoes & Accessories -->
                        <div class="w-full md:w-1/2 lg:w-1/3 p-4 border-b lg:border-b-0">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="h-6 w-6 text-indigo-500" viewBox="0 0 24 24">
                                    <path d="M12 2L2 7v7c0 5 10 9 10 9s10-4 10-9V7l-10-5z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Shoes</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Discover stylish shoes, belts, ties, and more to complement your daily look.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>

                        <!-- Student Tech Essentials -->
                        <div class="w-full md:w-1/2 lg:w-1/3 p-4">
                            <div class="flex items-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="h-6 w-6 text-indigo-500" viewBox="0 0 24 24">
                                    <path d="M4 4h16v2H4zm0 4h10v2H4zm0 4h16v2H4zm0 4h10v2H4z" />
                                </svg>
                                <h3 class="ml-3 text-xl font-semibold">Student Tech Essentials</h3>
                            </div>
                            <p class="mb-6 text-gray-600">
                                Keyboards, mice, flash drives, and all accessories a student needs for a productive
                                digital life.
                            </p>
                            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                                Shop Now
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </section>


    </UserLayouts>
</template>