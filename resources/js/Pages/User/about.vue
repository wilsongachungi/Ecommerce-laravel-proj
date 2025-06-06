<script setup>
import UserLayouts from './Layouts/UserLayouts.vue';
</script>

<template>
    <UserLayouts>
        <section class="py-24 bg-white dark:bg-gray-900">
            <div class="max-w-7xl px-4 mx-auto grid lg:grid-cols-2 gap-12 items-center">

                <!-- Text Content -->
                <div class="space-y-6">
                    <h2 class="text-4xl font-bold text-indigo-600 dark:text-white">
                        About Us
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                        At <strong class=" text-indigo-600">TechSphere Shop</strong>, we believe shopping should be simple, reliable, and
                        satisfying. That’s why we built a platform that offers high-quality products across electronics,
                        fashion, accessories, and home essentials — all curated with care and delivered with speed.
                    </p>
                    <p class="text-base text-gray-600 dark:text-gray-300 leading-relaxed">
                        Our mission is to provide customers with an effortless shopping experience backed by responsive
                        support, secure payments, and a wide selection of trusted brands. Whether you're upgrading your
                        tech or refreshing your style, we’re here to help you shop smarter.
                    </p>
                    <p class="text-base text-gray-600 dark:text-gray-300 leading-relaxed">
                        Proudly based in Kenya, we serve customers nationwide with fast delivery and excellent service.
                        Thank you for choosing TechSphere — your everyday store for everything you love.
                    </p>
                </div>

                <!-- Image -->
                <div class="flex justify-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS98Jb552eagViMuLjYtn8P16IhPNdLQIm52Q&s" alt="About TechSphere Shop"
                        class="rounded-3xl max-w-md w-full shadow-lg">
                </div>

            </div>
        </section>


    </UserLayouts>
</template>