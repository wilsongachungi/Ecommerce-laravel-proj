<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import UserLayouts from './Layouts/UserLayouts.vue'
import 'flowbite';

const email = ref('')
const phone = ref('')
const subject = ref('')
const message = ref('')


// Handle form submit
const submitForm = async () => {
  try {
    await router.post('/contact', {
      email: email.value,
      phone: phone.value,
      subject: subject.value,
      message: message.value
    }, {
      onSuccess: () => {
        email.value = ''
        phone.value = ''
        subject.value = ''
        message.value = ''
        alert('Message sent successfully!')
      },
    })
  } catch (err) {

  }
}


</script>

<template>
    <UserLayouts>
        <!-- WhatsApp Floating Button -->
        <a href="https://web.whatsapp.com/" target="_blank" rel="noopener noreferrer"
            class="fixed bottom-20 right-4 z-50 bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg transition duration-300 flex items-center space-x-2">
            <!-- WhatsApp Icon -->
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M20.52 3.48A11.89 11.89 0 0 0 12 0C5.37 0 0 5.37 0 12a11.9 11.9 0 0 0 1.69 6.09L0 24l6.22-1.63A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.18-3.48-8.52zM12 22.13a10.06 10.06 0 0 1-5.13-1.43l-.37-.22-3.69.97.98-3.58-.24-.37A10.03 10.03 0 1 1 12 22.13zm5.49-7.48c-.3-.15-1.77-.87-2.04-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.38-1.47-.88-.79-1.47-1.76-1.64-2.06-.17-.3-.02-.46.13-.6.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.6-.92-2.2-.24-.6-.48-.5-.67-.51l-.57-.01c-.2 0-.52.07-.8.37s-1.05 1.03-1.05 2.5 1.08 2.9 1.23 3.1c.15.2 2.13 3.24 5.17 4.54.72.31 1.28.5 1.72.64.72.23 1.38.2 1.9.12.58-.09 1.77-.72 2.03-1.41.25-.7.25-1.3.17-1.41-.08-.1-.27-.17-.57-.3z" />
            </svg>
            <!-- Optional: Label -->
            <span class="hidden sm:inline font-medium">Chat with us</span>
        </a>

        <section class="bg-white dark:bg-gray-900 mt-3">
            <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-indigo-600 dark:text-white">
                    Contact Us
                </h2>
                <p class="mb-8 lg:mb-16 font-light text-center text-gray-900 dark:text-gray-400 sm:text-xl">
                    Got a technical issue? Want to send feedback about a product? Need details about our services? Let
                    us know.
                </p>
                <form @submit.prevent="submitForm" class="space-y-8">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your
                            email</label>
                        <input type="email" id="email" name="email" required v-model="email"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Phone
                            number</label>
                        <input type="tel" id="phone" name="phone" pattern="[0-9]{10,15}" placeholder="e.g. 0712345678"
                            v-model="phone" required
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="subject"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                        <input type="text" id="subject" name="subject" required v-model="subject"
                            class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="message"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your message</label>
                        <textarea id="message" name="message" rows="6" required v-model="message"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                            placeholder="Leave a comment..."></textarea>
                    </div>

                    <button type="submit"
                        class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-indigo-600 sm:w-fit hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-600 dark:focus:ring-indigo-800">
                        Send message
                    </button>
                </form>
            </div>
        </section>

    </UserLayouts>
</template>