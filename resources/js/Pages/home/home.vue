o<script setup>
import {Head} from '@inertiajs/vue3';

import navbar from '../../Components/home/navbar.vue';
import heroSection from '../../Components/home/heroSection.vue';
import aboutSection from '../../Components/home/aboutSection.vue'
import featureSection from '../../Components/home/featureSection.vue'
import screenshotSection from '../../Components/home/screenshotSection.vue'
import clientSection from '../../Components/home/clientSection.vue'
import pricingSection from '../../Components/home/pricingSection.vue'
import peopleSection from '../../Components/home/peopleSection.vue'
import footerSection from '../../Components/home/footerSection.vue'



</script>

<template>

<Head title="StockPilot" >

    <link rel="icon" type="image/x-icon" href="/dashboard/img/fav.png">



</Head>

<navbar/>

<div data-bs-spy="scroll" data-bs-target="#main_nav" data-bs-offset="71" class="scrollspy-example" data-bs-smooth-scroll="true">

<heroSection/>
<aboutSection/>
<featureSection/>
<screenshotSection/>
<clientSection/>
<pricingSection/>
<peopleSection/>
<footerSection/>

</div>





</template>

<style scoped>




</style>
