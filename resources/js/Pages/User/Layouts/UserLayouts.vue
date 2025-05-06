<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Header from './Header.vue';
import Footer from './Footer.vue';
import Hero from './Hero.vue';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})

</script>

<template>
    
<div>
    <Header></Header>

  

<!--hero section-->
<Hero></Hero>

<!--Main-->

<slot/>

<Footer></Footer>
</div>



</template>